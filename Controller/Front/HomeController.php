<?php

namespace App\Controller\Front;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     *  @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('front-office\home\home.html.twig', []);
    }

    /**
     *  @Route("/test", name="test")
     */
    public function test()
    {
        return $this->render('front-office\home\test.html.twig');
    }











     /**
     *  @Route("/home2", name="home2")
     */
    public function home2()
    {
        $url = "ressources/img/gallery/img4.jpg";
        $url2 = "ressources/logo/logo_blanc.png";

        $contentDescription = [
            'moto' => [
                'text' => "\"Les souvenirs de demain sont faits aujourd'hui\"",
                'color' => "text-sb-orange",
            ],
            'title' => [
                'text' => "Bienvenue au Studio Bontant",
                'color' => "text-sb-blue-energy",
            ],
            'subtitle' => [
                'text' => "Paris 12 - Gare de Lyon",
                'color' => "text-sb-blue-l",
            ],
            'desc' => [
                'text' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus dignissimos laudantium, eaque nam dolores nemo. Sit, eos possimus. Molestiae accusamus consequuntur recusandae quos, quia nemo harum distinctio, voluptatem fugit ratione qui necessitatibus. Dolore, consequuntur! Tenetur dicta eius repellat consequuntur, minus alias.",
                'color' => "text-sb-gray-d",
            ],
            'img' => [ 
                'url' => $url,
                'alt' => "Photo du Studio Bontant",
            ],
            'svg' => [
                'active' => true,
            ],
        ];

        $contentBandeauBleu = [
            'moto' => [
                'text' => "que ce moment ne soit que du plaisir !",
                'color' => "text-sb-white",
            ],
            'title' => [
                'text' => "Notre objectif :",
                'color' => "text-sb-blue-energy",
            ],
            'desc' => [
                'text' => "C'est pas tous les jours qu'on a l'occasion de faire un shooting photo !",
                'color' => "text-sb-white",
            ],
            'desc2' => [
                'text' => "Plaisir de ",
                'color' => "text-sb-white ",
                'span' => "se trouver beau / belle",
                'color2' => "text-sb-yellow"
            ],
            'logo' => [
                'url' => $url2,
                'alt' => "Logo blanc du Studio Bontant",
            ],
        ];

        return $this->render('front-office\home\home2.html.twig', [
            'description' => $contentDescription,
            'bandeauBleu' => $contentBandeauBleu,
        ]);
    }

     /**
     *  @Route("/home3", name="home3")
     */
    public function home3()
    {
        $url = "ressources/img/gallery/2016-02-19_18-02_CAA_4728.jpg";
        $url2 = "ressources/logo/logo_blanc.png";

        $content1 = [
            'moto' => [
                'text' => "Un message personalisé",
                'color' => "text-orange",
            ],
            'title' => [
                'text' => "Je suis un joli titre",
                'color' => "text-primary",
            ],
            'subtitle' => [
                'text' => "Le titre au dessus de moi est magnifique !",
                'color' => "text-light",
            ],
            'desc' => [
                'text' => "Je trouve que les titres plus haut se la raconte un peu !",
                'color' => "text-black",
            ],
            'img' => [ 
                'url' => $url,
                'alt' => "image d'une femme en chemisier blanc",
            ],
            'logo' => [ 
                'url' => $url2,
                'alt' => "",
            ],
        ];

        $content2 = [
            'moto' => [
                'text' => "Je suis une phrase en gras ...",
                'color' => "text-white",
            ],
            'title' => [
                'text' => "Le petit titre tout mignon",
                'color' => "text-primary",
            ],
            'subtitle' => [
                'text' => "",
                'color' => "",
            ],
            'desc' => [
                'text' => "Je suis un simple texte de test ... Je suis amené à disparaitre );",
                'color' => "text-white ",
            ],
            'desc2' => [
                'text' => "Je suis aussi un simple texte de test ... ",
                'color' => "text-white ",
                'span' => "mais je vais me battre pour rester vivant !",
                'color2' => "text-yellow"
            ],
            'img' => [ 
                'url' => $url,
                'alt' => "",
            ],
            'logo' => [ 
                'url' => $url2,
                'alt' => "Logo du Studio Bontant",
            ],
        ];

        $content3 = [
            'moto' => [
                'text' => "Un message personalisé 2",
                'color' => "text-orange",
            ],
            'title' => [
                'text' => "Je suis un joli titre 2",
                'color' => "text-primary",
            ],
            'subtitle' => [
                'text' => "Le titre au dessus de moi est magnifique ! 2",
                'color' => "text-light",
            ],
            'desc' => [
                'text' => "Je trouve que les titres plus haut se la raconte un peu ! 2",
                'color' => "text-black",
            ],
            'img' => [ 
                'url' => $url,
                'alt' => "image d'une femme en chemisier blanc 2",
            ],
            'logo' => [ 
                'url' => $url2,
                'alt' => "",
            ],
        ];
        

        return $this->render('front-office\home\home3.html.twig', [
            'content1' => $content1,
            'content2' => $content2,
            'content3' => $content3
        ]);
    }
}