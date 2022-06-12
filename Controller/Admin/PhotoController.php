<?php

namespace App\Controller\Admin;

use DateTime;
use App\Service\Photo\PhotoService;
use App\Form\PhotoType;
use App\Entity\GaleriePhotos;
use App\Repository\GalerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PhotoController extends AbstractController
{
    protected $parameterBag;
    protected $photoService;

    public function __construct(ParameterBagInterface $parameterBag, PhotoService $photoService)
    {
        $this->parameterBag = $parameterBag;
        $this->photoService = $photoService;
    }

    /**
     *  @Route("/admin/galerie/{id}/add", name="adminPhotoAdd", methods={"GET", "POST"})
     */
    public function GestionPhotoAdd(Request $request, EntityManagerInterface $em, GalerieRepository $galerieRepository, $id)
    {
        $photo = new GaleriePhotos();
        $galerie = $galerieRepository->find($id);
        $form = $this->createForm(PhotoType::class, $photo);

        $photo->setActif(false)
              ->setGalerieId($galerie)
              ->setFiledate(new DateTime())
              ->setOrdre($id);
            

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $photo = $form->getData();
            $em->persist($photo);
            $size = $this->photoService->getPhotoSize($photo->getImageName());
            if($size != false) {
                $photo->setDimensionX($size[0]);
                $photo->setDimensionY($size[1]);
                $em->persist($photo);
            }
            else {
                $this->photoService->deletePhoto($photo->getImageName());
                $em->remove($photo);
            }
            $em->flush();

            return $this->redirectToRoute('adminGaleriePhotos', ['id' => $id]);
        }

        $formView = $form->createView();

        return $this->render('admin/galerie-photos/photo-add.html.twig', [
            'formView' => $formView,
            'id' => $id
        ]);
    }
}