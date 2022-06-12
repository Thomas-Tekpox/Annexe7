<?php

namespace App\Controller\Admin;

use App\Repository\GaleriePhotosRepository;
use App\Service\Photo\PhotoService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GaleriePhotosController extends AbstractController
{
    /**
     *  @Route("/admin/galerie/{id}", name="adminGaleriePhotos", methods={"GET"})
     */
    public function galerie($id ,GaleriePhotosRepository $galeriePhotosRepository, PhotoService $photoService)
    {
        $galeries =  $galeriePhotosRepository->findBy(['galerie_id' => $id]);
        return $this->render('admin/galerie-photos/galerie-photos.html.twig', [
            'galeries' => $galeries,
            'id' => $id
        ]);
    }
}