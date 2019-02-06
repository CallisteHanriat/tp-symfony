<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Movie;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Forms\FilmType;


class FilmController extends AbstractController
{
    /**
    * Matches /films exactly
    *
    * @Route("/getFilm/detail/{id}", name="getFilmById")
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
    public function editFilm($id, Request $request) {
        $criteria = array(
            "id" => $id
        );
        $movie = $this->getDoctrine()->getRepository(Movie::class)->findOneBy($criteria);
        
        $form = $this->createFormBuilder($movie)
            ->add('name', TextType::class)
            ->add('update', SubmitType::class, ['label' => 'Edit Movie'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $movie = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();
    
            return $this->redirectToRoute('getLitFilms');
        }

        return $this->render('films/film-edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * Matches /films exactly
    *
    * @Route("/createFilm", name="createFilm")
    */
    public function createFilm(Request $request) {

        $movie = new Movie();
        $movie->setName('');
        $form = $this->createForm(FilmType::class, $movie);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $movie = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();
    
            return $this->redirectToRoute('getLitFilms');
        }
        return $this->render('films/film-create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

?>