<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GaleriePersoController extends AbstractController
{
    /**
     *  @Route("/galerie/{username}", name="galeriePerso", methods={"GET"})
     */
    public function galeriePerso()
    {
        return $this->render('front-office/galerie-perso/galerie-perso.html.twig');
    }

    /**
     *  @Route("/galerie/{username}/g", name="galeriePersog", methods={"GET"})
     */
    public function galeriePersog()
    {
        return $this->render('front-office/galerie-perso/galerie-perso.html.twig');
    }
}
