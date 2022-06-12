<?php

namespace App\Controller\Admin;

use App\Form\PageType;
use App\Repository\PageRepository;
use App\Repository\BriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SiteController extends AbstractController
{
    /**
     *  @Route("/admin/site", name="adminSite", methods={"GET", "POST"})
     */
    public function site(PageRepository $pageRepository) {
        return $this->render('admin/site/site.html.twig', [
            'pages' => $pageRepository->findAll(),
        ]);
    }

    /**
     *  @Route("/admin/site-page-add", name="adminSitePageAdd", methods={"GET", "POST"})
     */
    public function sitePageAdd(BriqueRepository $briqueRepository, EntityManagerInterface $em, Request $request, SluggerInterface $slugger) {

        $form = $this->createForm(PageType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $page = $form->getData();
            $page->setActive(false)
                 ->setUrl(strtolower($slugger->slug($page->getUrl())));
            
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('adminSite');
        }

        $formView = $form->createView();

        return $this->render('admin/site/site-page-add.html.twig', [
            'briques' => $briqueRepository->findAll(),
            'formView' => $formView,
        ]);

        /**
         * IMPORTANT !
         * 
         * J'ai 2 options :
         * - on concidère que les tables briques et pages pourrons toujours êtres chargées via de simple requête (donc pas d'ajax)
         * - on concidère que les tables briques et pages ne pourrons pas toujours être chargées via de simple requête (donc ajax)
         * 
         * DEMANDER A PATRICK DE FAIRE LA PARTIE AJAX OU DE M'EXPLIQUER
         * 
         * DESCRIPTION DE LA SECTION
         * 
         * J'ai créée 2 tables (page et brique) + une table de jointure automatique
         * La table brique stockera et donnera l'url et l'id de chaque brique
         * La table page stockera l'id d'une page, son url, l'ordre et les briques qui la compose et si elle est active ou non (RAJOUTER SANS DOUTE UN CHAMP POUR L'ORDRE DES BRIQUES SUR UNE PAGE DONNéE)
         * 
         * Je n'ai pas encore réfléchis au contenu des différentes zone de textes et boutton de chaques briques
         * 2 idées :
         * - faire une table ou plusieurs tables qui les stocks ?
         * - voir si on peut mettre des blocks dans des pages à include => si oui alors écho les blocs correspondant dans les nouvelles pages et echo en php le ou les textes ?
         * 
         */

    }

    /**
     *  @Route("/admin/site-brique-add", name="adminSiteBriqueAdd", methods={"GET", "POST"})
     */
    public function siteBriqueAdd(BriqueRepository $briqueRepository) {
        return $this->render('admin/site/site-brique-add.html.twig', [
            'briques' => $briqueRepository->findAll(),
        ]);
    }


































    /**
     *  @Route("/admin/site-page-add2", name="adminSitePageAdd2", methods={"GET", "POST"})
     */
    public function sitePageAdd2(BriqueRepository $briqueRepository, EntityManagerInterface $em, Request $request, SluggerInterface $slugger) {

        $form = $this->createForm(PageType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $page = $form->getData();
            $page->setActive(false)
                 ->setUrl(strtolower($slugger->slug($page->getUrl())));
            
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('adminSite');
        }

        $formView = $form->createView();

        return $this->render('admin/site/site-page-add2.html.twig', [
            'briques' => $briqueRepository->findAll(),
            'formView' => $formView,
        ]);
    }

    /**
     *  @Route("/admin/site-page-add3", name="adminSitePageAdd3", methods={"GET", "POST"})
     */
    public function sitePageAdd3(BriqueRepository $briqueRepository, EntityManagerInterface $em, Request $request, SluggerInterface $slugger) {

        $form = $this->createForm(PageType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $page = $form->getData();
            $page->setActive(false)
                 ->setUrl(strtolower($slugger->slug($page->getUrl())));
            
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('adminSite');
        }

        $formView = $form->createView();

        return $this->render('admin/site/site-page-add3.html.twig', [
            'briques' => $briqueRepository->findAll(),
            'formView' => $formView,
        ]);
    }

    

    /**
     *  @Route("/admin/briques_data", name="briques_data", methods={"GET"})
     */
    public function briques_data(BriqueRepository $briqueRepository, Request $request):JsonResponse {

        $tri = array("nom" => $request->get('order')[0]["dir"]);

        $briques = $briqueRepository->findBy([], $tri, $request->query->get('length'), $request->query->get('start'));
        $draw= $request->query->get('draw');

        $data = array();
        $length = 0;
        foreach ($briques as $brique) {
            $data[] = array(
                'nom' => $brique->getNom(),
            );
            $length++;
        }

        $briquettes['data'] = $data;
        $briquettes['recordsTotal'] = $length;
        $briquettes['draw'] = $draw;

        return new jsonResponse($briquettes);
    }
}