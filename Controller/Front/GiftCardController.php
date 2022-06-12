<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GiftCardController extends AbstractController
{
    /**
     *  @Route("/carte-cadeau", name="carteCadeau")
     */
    public function home()
    {
        return $this->render('front-office\carte-cadeau\gift-card.html.twig', [
            'photoPath' => 'ressources/img/profilePictures/'
        ]);
    }

}
