<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
    * @Route("/admin/custom", name="adminCustom")
    */
    public function hello()
    {
        return $this->render('admin/custom/helloworld.html.twig', []);
    }

    /**
     *  @Route("/admin/test", name="adminTest", methods={"GET", "POST"})
     */
    public function test()
    {
        return $this->render('admin/test/serverSide.html.twig', []);
    }

    /**
     *  @Route("/admin/test/add", name="adminTestAdd", methods={"GET", "POST"})
     */
    public function testAdd()
    {
       
    }

    /**
     *  @Route("/admin/test/edit", name="adminTestEdit", methods={"GET", "POST"})
     */
    public function testEdit()
    {
        
    }
}