<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\CodePromo;
use App\Form\CodePromoType;
use App\Entity\ProduitCodePromo;
use App\Repository\ProduitRepository;
use App\Repository\CodePromoRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\CodePromo\CodePromoService;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProduitCodePromoRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CodePromoController extends AbstractController
{
    /**
     *  @Route("/admin/code-promo", name="adminCodePromo", methods={"GET"})
     */
    public function codePromo(CodePromoRepository $codePromoRepository, ProduitCodePromoRepository $produitCodePromoRepository)
    {
        return $this->render('admin/code-promo/code-promo.html.twig', [
            'codesPromo' => $codePromoRepository->findAll(),
            'produitsCodePromo' => $produitCodePromoRepository->findAll()
        ]);
    }

    /**
     *  @Route("/admin/code-promo/add", name="adminCodePromoAdd", methods={"GET", "POST"})
     */
    public function codePromoAdd(Request $request, EntityManagerInterface $em, ProduitRepository $produitRepository, CodePromoService $codePromoService)
    {
        $produits = $produitRepository->findByOrdreEligiblePromo();

        $today = date_format(DateTime::createFromFormat('j-m-Y h:i:s', date('j-m-Y h:i:s')), 'j-m-Y h:i:s');

        $codePromo = new CodePromo();
        $pcp = new ProduitCodePromo();
        foreach ($produits as $produit) {
            $pcp->setProduit($produit)
                ->setCodePromo($codePromo)
                ->setQuantite(0);
            $codePromo->getProduit()->add($pcp);
        }
        
        $form = $this->createForm(CodePromoType::class, $codePromo);
        
        $form->handleRequest($request);
        // dd($form->isSubmitted());
        
        if($form->isSubmitted()) {
            $em->clear();
            $codePromo = $form->getData();

            
            $codePromo->setCode($codePromoService->genererChaineAleatoire(10))
            ->setDateC(DateTime::createFromFormat('j-m-Y h:i:s', $today));
            
            $em->persist($codePromo);
            $em->flush();

            foreach ($produits as $produit) {
                if($request->get('quantite'.$produit->getId())) {
                    $produitCodePromo = new ProduitCodePromo;
                    $produitCodePromo->setCodePromo($codePromo)
                                     ->setProduit($produit)
                                     ->setQuantite($request->get('quantite'.$produit->getId()));
                    dd($request->get('quantite'.$produit->getId()));
                    $em->persist($produitCodePromo);
                    $em->flush();
                }
            }

            return $this->redirectToRoute('adminCodePromo');
        }

        $formView = $form->createView();

        return $this->render('admin/code-promo/code-promo-add.html.twig', [
            'formView' => $formView,
            'produits' => $produits
        ]);
    }

    /**
     *  @Route("/admin/code-promo/edit", name="adminCodePromoEdit", methods={"GET"})
     */
    public function codePromoEdit(CodePromoRepository $codePromoRepository, ProduitRepository $produitRepository, ProduitCodePromoRepository $produitCodePromoRepository, Request $request)
    {
        return $this->render('admin/code-promo/code-promo-edit.html.twig', [
            'codepromo' => $codePromoRepository->find($request->query->get('id')),
            'produits' => $produitRepository->findByOrdreEligiblePromo(),
            'pcps' => $produitCodePromoRepository->findAll()
        ]);
    }

    /**
     *  @Route("/admin/code-promo", name="adminCodePromoDelete", methods={"POST"})
     */
    public function codePromoDelete(CodePromoRepository $codePromoRepository, ProduitCodePromoRepository $produitCodePromoRepository, Request $request, EntityManagerInterface $em)
    {
        $produitsCodePromo = $produitCodePromoRepository->findAll();

        dump($request->get('id'));

        foreach ($produitsCodePromo as $pcp) {
            if ($pcp->getCodePromo()->getId() == $request->get('id')) {
                $em->remove($pcp);
            }
        }
        $em->flush();

        $codepromo = $codePromoRepository->find($request->get('id'));
        $em->remove($codepromo);
        $em->flush();

        $this->addFlash('success', 'Code pormo supprimé avec succès');
        $em->clear();
        
        return $this->redirectToRoute('adminCodePromo');
    }

    /**
     *  @Route("/admin/code-promo/edit", name="adminCodePromoEditForm", methods={"POST"})
     */
    public function codePromoEditForm(ProduitCodePromoRepository $produitCodePromoRepository, CodePromoRepository $codePromoRepository, ProduitRepository $produitRepository, EntityManagerInterface $em, Request $request)
    {
        /* Les validations de champs peuvent être factoriser : cf -> dossier Function */
        $this->date = new \DateTime('now');
        $trigger = false;
        $negQty = false;
        $produits = $produitRepository->findByOrdreEligiblePromo();
        $pcps = $produitCodePromoRepository->findAll();

        if (!$request) {
            $this->addFlash('error', "La requête d'ajout d'un code promo est vide");
            return $this->redirectToRoute('codePromoAdd');
        }
        else {
            if ($request->get('typePromo') == "") {    
                $this->addFlash('error', "Le type de promotion doit être renseigné");
                $trigger = true;
            }
            if ($request->get('DLC') < $this->date->format('Y-m-d')) {
                $this->addFlash('error', "La date limite de consomation ne peut pas être antérieur à la date du jour");
                $trigger = true;
            }
            if ($request->get('montant') == 0) {
                $this->addFlash('error', "Le montant d'un code promo ne peut pas être de 0€");
                $trigger = true;
            }
            if ($request->get('montant') < 0) {
                $this->addFlash('error', "Le montant d'un code promo ne peut pas être négatif");
                $trigger = true;
            }
            if ($request->get('typePromo') == "e" && $request->get('montant')>1000) {
                $this->addFlash('error', "Le montant d'un code promo ne peut pas éxcéder 1000€");
                $trigger = true;
            }
            if ($request->get('typePromo') == "p" && $request->get('montant')>100) {
                $this->addFlash('error', "Le montant d'un code promo ne peut pas éxcéder 100%");
                $trigger = true;
            }
            if ($request->get('montantMinimum') < 0) {
                $this->addFlash('error', "Le montant minimum d'un code promo ne peut pas être négatif");
                $trigger = true;
            }
            if ($request->get('montantMinimum') > 1000) {
                $this->addFlash('error', "Le montant minimum d'un code promo ne peut pas éxcéder 1000€");
                $trigger = true;
            }

            foreach ($produits as $produit) {
                if ($request->get("quantite".$produit->getOrdreEligiblePromo()) < 0 && $request->get("quantite".$produit->getOrdreEligiblePromo()) != "") {
                    $trigger = true;
                    $negQty= true;
                }
            }
            if ($negQty) {
                $this->addFlash('error', "La quantite minimum d'un produit lié au code promo ne peut pas être négative");
            }

            if ($trigger) {
                return $this->redirectToRoute('adminCodePromoAdd');
            }
        }

        $DLC = date_format(DateTime::createFromFormat('Y-m-j', $request->get('DLC')), 'j-m-Y');
        // $DLC = DateTime::createFromFormat('j-m-Y', $DLC);
        if(!$request->get('fraisDePortOfferts')) {
            $FP = false;
        }
        else {
            $FP = true;
        }

        $codepromo = $codePromoRepository->find((int)$request->get('id'));
        
        if (!$codepromo) {
            throw $this->createNotFoundException(
                'No code-promo found for id '.$request->get('id')
            );
        }

        $codepromo->setDLC(DateTime::createFromFormat('j-m-Y', $DLC))
                  ->setFraisDePortOfferts($FP)
                  ->setMontant($request->get('montant'))
                  ->setMontantMinimum($request->get('montantMinimum'))
                  ->setTypePromo($request->get('typePromo'));
        $em->flush();

        foreach ($produits as $produit) {
            foreach ($pcps as $pcp) {
                if ($produit->getID() == $pcp->getProduit()->getId() && $pcp->getCodePromo()->getId() == $codepromo->getId()) {
                    //DELETE
                    $em->remove($pcp);
                    $em->flush();
                }
            }
            if ($request->get("quantite".$produit->getOrdreEligiblePromo()) != "" && $request->get("quantite".$produit->getOrdreEligiblePromo()) != 0) {
                //INSERT
                $thisProduitCodePromo = "produitCodePromo".$produit->getOrdreEligiblePromo();
                $$thisProduitCodePromo = new ProduitCodePromo();

                $$thisProduitCodePromo->setProduit($produitRepository->find($produit->getID()))
                                      ->setCodePromo($codePromoRepository->find($codepromo->getId()))
                                      ->setQuantite((int)$request->get("quantite".$produit->getOrdreEligiblePromo()));

                $em->persist($$thisProduitCodePromo);
                $em->flush();
            }
        }
        $em->clear();

        $this->addFlash('success', 'Code promo modifié avec succès');

        return $this->redirectToRoute('adminCodePromo');
    }
}