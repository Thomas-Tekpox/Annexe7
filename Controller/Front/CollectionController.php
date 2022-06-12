<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    /**
     *  @Route("/collection", name="collection")
     */
    public function collection()
    {
        return $this->render('front-office\collection\collection.html.twig', [
            'photos' => [
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 0
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 1
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 2
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 3
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 4
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 5
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 6
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 7
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 8
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 9
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 10
                ],
                [ 'link' => '/ressources/img/gallery/Jade-0005.webp',
                  'num' => 11
                ],
            ]
        ]);
    }
}
