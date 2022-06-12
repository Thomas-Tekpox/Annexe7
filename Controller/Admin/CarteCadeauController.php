<?php

namespace App\Controller\Admin;

use DateTime;
use App\Form\CarteCadeauType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CarteCadeauRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarteCadeauController extends AbstractController
{
    /**
     *  @Route("/admin/carte-cadeau", name="adminCarteCadeau", methods={"GET", "POST"})
     */
    public function carteCadeau(CarteCadeauRepository $carteCadeauRepository)
    {
        return $this->render('admin/carte-cadeau/carte-cadeau.html.twig', [
            'cartesCadeau' => $carteCadeauRepository->findAll()
        ]);
    }

    /**
     *  @Route("/admin/carte-cadeau/add", name="adminCarteCadeauAdd", methods={"GET", "POST"})
     */
    public function carteCadeauAdd(Request $request, EntityManagerInterface $em)
    {
        $today = date_format(DateTime::createFromFormat('j-m-Y h:i:s', date('j-m-Y h:i:s')), 'j-m-Y h:i:s');

        $form = $this->createForm(CarteCadeauType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $carteCadeau = $form->getData();
            $carteCadeau->setSolde($carteCadeau->getMontant())
                        ->setDateC(DateTime::createFromFormat('j-m-Y h:i:s', $today))
                        ->setDateM(DateTime::createFromFormat('j-m-Y h:i:s', $today));
            
            $em->persist($carteCadeau);
            $em->flush();

            return $this->redirectToRoute('adminCarteCadeau');
        }

        $formView = $form->createView();

        return $this->render('admin/carte-cadeau/carte-cadeau-add.html.twig', [
            'formView' => $formView,
        ]);
    }

    /**
     *  @Route("/admin/carte-cadeau/edit", name="adminCarteCadeauEdit", methods={"GET", "POST"})
     */
    public function carteCadeauEdit(request $request, CarteCadeauRepository $carteCadeauRepository, EntityManagerInterface $em)
    {
        $carteCadeau = $carteCadeauRepository->find($request->query->get('id'));

        $form = $this->createForm(CarteCadeauType::class, $carteCadeau);

        $formView = $form->createView();

        $form->HandleRequest($request);

        if($form->isSubmitted()) {
            $em->flush();

            return $this->redirectToRoute('adminCarteCadeau');
        }

        return $this->render('admin/carte-cadeau/carte-cadeau-edit.html.twig', [
            'carteCadeau' => $carteCadeau,
            'formView' => $formView,
        ]);
    }
}