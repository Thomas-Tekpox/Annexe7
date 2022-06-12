<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    /**
     *  @Route("/prestations-pro", name="prestations-pro", methods={"GET"})
     */
    public function prestaPro()
    {
        return $this->render('front-office/prestations-pro/prestations-pro.html.twig');
    }
}