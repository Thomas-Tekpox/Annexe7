<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoffretDescController extends AbstractController
{
    /**
     *  @Route("/coffret-desc", name="coffretDesc")
     */
    public function index()
    {
        return $this->render('front-office\coffret-desc\coffret-desc.html.twig', [
            'controller_name' => 'CoffretDescController',
        ]);
    }
}
