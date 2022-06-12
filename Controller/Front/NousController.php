<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NousController extends AbstractController
{
    /**
     *  @Route("/nous", name="nous", methods={"GET"})
     */
    public function nous()
    {
        return $this->render('front-office/nous/nous.html.twig');
    }
}