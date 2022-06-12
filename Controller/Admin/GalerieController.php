<?php

namespace App\Controller\Admin;

use App\Form\GalerieType;
use App\Repository\GalerieRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GalerieController extends AbstractController
{
    /**
     *  @Route("/admin/galerie", name="adminGalerie", methods={"GET"})
     */
    public function galerie(GalerieRepository $galerieRepository)
    {
        return $this->render('admin/galerie/galerie.html.twig', [
            'galeries' => $galerieRepository->findAll(),
        ]);
    }

    /**
     *  @Route("/admin/galerie/add", name="adminGalerieAdd", methods={"GET", "POST"})
     */
    public function galerieAdd(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(GalerieType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $galerie = $form->getData();
            
            $galerie->setDateC(new DateTime())
                    ->setDateM(new DateTime());
            $em->persist($galerie);
            $em->flush();

            return $this->redirectToRoute('adminGalerie');
        }

        $formView = $form->createView();

        return $this->render('admin/galerie/galerie-add.html.twig', [
            'formView' => $formView,
        ]);
    }

    /**
     *  @Route("/admin/galerie/edit", name="adminGalerieEdit", methods={"GET", "POST"})
     */
    public function galerieEdit(GalerieRepository $galerieRepository)
    {
        return $this->render('admin/galerie/galerie-edit.html.twig', [
            'galeries' => $galerieRepository->findAll(),
        ]);
    }
}