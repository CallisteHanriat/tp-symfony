<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AboutController extends AbstractController
{
    private $names;
    /**
    * Matches /about exactly
    *
    * @Route("/about", name="about")
    */
    public function about()
    {
        $names = Array("Calliste HANRIAT", "Nicolas Sarkozy");
        return $this->render('about.html.twig', [
            "creators" => $names
        ]);   
    }
}

?>