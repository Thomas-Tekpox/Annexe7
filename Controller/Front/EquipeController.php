<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{
    /**
     *  @Route("/equipe", name="equipe", methods={"GET"})
     */
    public function equipe()
    {
        return $this->render('front-office/equipe/equipe.html.twig');
    }
}