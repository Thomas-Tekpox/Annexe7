<?php

namespace App\Controller\Front;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     *  @Route("/contact", name="contact", methods={"GET"})
     */
    public function index()
    {
        return $this->render('front-office/contact/contact.html.twig');
    }

    /**
     *  @Route("/contact", name="contactmsg", methods={"POST"})
     */
    public function add(Request $request)
    {
        return $this->redirectToRoute('contact');
    }
}
