<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Movie;
use Symfony\Component\HttpFoundation\JsonResponse;

class FilmsController extends AbstractController
{
    /**
    * Matches /films exactly
    *
    * @Route("/getFilms", name="getLitFilms")
    */
    public function films()
    {
        $films = $this->getDoctrine()->getRepository(Movie::class)->findAll();

        if (!$films) {
            throw $this->createNotFoundException(
                'No films found'
            );
        }
        return $this->render('films/listFilms.html.twig', [
            "films" => $films
        ]);

        //return new JsonResponse($films);
    }
}

?>