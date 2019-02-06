<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Movie;
use Symfony\Component\HttpFoundation\JsonResponse;

class FilmController extends AbstractController
{
    /**
    * Matches /films exactly
    *
    * @Route("/getFilm/{id}", name="getFilmById")
    */
    public function getFilm($id) {
        $criteria = array(
            "id" => $id
        );
        $film = $this->getDoctrine()->getRepository(Movie::class)->findOneBy($criteria);
        return $this->render('films/film.html.twig', [
            "film" => $film
        ]);
    }

    /**
    * Matches /films exactly
    *
    * @Route("/getFilm/{id}/edit", name="editFilmById")
    */
    public function editFilm($id) {
        $criteria = array(
            "id" => $id
        );
        $film = $this->getDoctrine()->getRepository(Movie::class)->findOneBy($criteria);
        return $this->render('films/film.html.twig', [
            "film" => $film
        ]);
    }
}

?>