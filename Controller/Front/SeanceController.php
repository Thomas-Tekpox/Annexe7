<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SeanceController extends AbstractController
{
    /**
     *  @Route("/seance", name="seance", methods={"GET"})
     */
    public function seance()
    {
        return $this->render('front-office/seance/seance.html.twig');
    }
}