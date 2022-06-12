<?php

namespace App\Controller\Front;


use App\Service\Panier\PanierService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    public $panierService;

    public function __construct(PanierService $panierService)
    {
        $this->panierService = $panierService;
    }

    /**
     *  @Route("/panier/commande", name="panier")
     */
    public function index()
    {
        return $this->render('front-office\panier\panier.html.twig', []);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add", requirements={"id":"\d+"})
     */
    public function add($id)
    {
        $addSuccess = $this->panierService->add($id);

        dd($addSuccess);
    }

    /**
     * @Route("/panier", name="panier_show")
     */
    public function show() {
        $panierDetail = $this->panierService->getPanierDetail();
        $total = $this->panierService->getTotal();

        return $this->render('front-office\panier\monPanier.html.twig', [
            'objets' => $panierDetail,
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/delete/{id}", name="panier_delete", requirements={"id":"\d+"})
     */
    public function delete($id) {
        $this->panierService->remove($id);

        $this->addFlash('success', 'La commande a bien été supprimée du panier');

        return $this->redirectToRoute('panier_show');
    }

    /**
     * @Route("/panier/decrement/{id}", name="panier_decrement", requirements={"id":"\d+"})
     */
    public function decrement($id) {
        $this->panierService->decrement($id);

        return $this->redirectToRoute('panier_show');
    }
}