<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GalerieController extends AbstractController
{
    /**
     *  @Route("/galerie", name="galerie", methods={"GET"})
     */
    public function galerie()
    {
        return $this->render('front-office/galerie/galerie.html.twig');
    }
}