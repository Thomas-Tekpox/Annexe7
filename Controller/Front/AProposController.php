<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AProposController extends AbstractController
{
    /**
     *  @Route("/a-propos", name="a-propos", methods={"GET"})
     */
    public function apropos()
    {
        return $this->render('front-office/a-propos/a-propos.html.twig');
    }
}
