<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
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
     * @ORM\OneToMany(targetEntity="App\Entity\Movie", mappedBy="director")
     */
    private $moviesDirectedBy;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movie", inversedBy="actors")
     */
    private $movies;

    public function __construct()
    {
        $this->director = new ArrayCollection();
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

    /**
     * @return Collection|Movie[]
     */
    public function getDirector(): Collection
    {
        return $this->director;
    }

    public function addDirector(Movie $director): self
    {
        if (!$this->director->contains($director)) {
            $this->director[] = $director;
            $director->setDirector($this);
        }

        return $this;
    }

    public function removeDirector(Movie $director): self
    {
        if ($this->director->contains($director)) {
            $this->director->removeElement($director);
            // set the owning side to null (unless already changed)
            if ($director->getDirector() === $this) {
                $director->setDirector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Movie $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(Movie $actor): self
    {
        if ($this->actors->contains($actor)) {
            $this->actors->removeElement($actor);
        }

        return $this;
    }

    public function __toString(){
        return $this->getName().' ['.$this->id.']';
    }
}
