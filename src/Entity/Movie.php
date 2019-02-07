<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="movies")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="moviesDirectedBy")
     */
    private $director;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", mappedBy="movies")
     */
    private $actors;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDirector(): ?Person
    {
        return $this->director;
    }

    public function setDirector(?Person $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Person $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
            $actor->addActor($this);
        }

        return $this;
    }

    public function removeActor(Person $actor): self
    {
        if ($this->actors->contains($actor)) {
            $this->actors->removeElement($actor);
            $actor->removeActor($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
