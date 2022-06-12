<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     *  @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->redirectToRoute('adminPlanning');
    }

    /**
     *  @Route("/admin/helloworld", name="helloworld")
     */
    public function devPatrick()
    {
        return $this->render('admin\custom\helloworld.html.twig');
    }
}
