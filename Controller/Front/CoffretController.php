<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoffretController extends AbstractController
{
    /**
     *  @Route("/coffret", name="coffret")
     */
    public function index()
    {
        return $this->render('front-office\coffret\coffret.html.twig', [
            'controller_name' => 'CoffretController',
        ]);
    }
}