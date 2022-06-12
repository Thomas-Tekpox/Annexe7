<?php

namespace App\Controller\Admin;

use App\Repository\CodePromoRepository;
use App\Repository\TestRepository;
use App\Service\Phone\PushNotifierService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class PboController extends AbstractController
{
    /**
     *  @Route("/admin/pbo", name="adminPBO", methods={"GET", "POST"})
     */
    public function pbo() {
        return $this->render('admin/pbo/pbo.html.twig', []);
    }

       /**
     *  @Route("/admin/pbo_data", name="adminPBOdata", methods={"GET", "POST"})
     */
    public function pbo_data(TestRepository $testRepository, Request $request) {
  
        $tri=array($request->get('columns')[$request->get('order')[0]["column"]]["name"] => $request->get('order')[0]["dir"]);

        $tests = $testRepository->findBy([],  $tri, $request->query->get('length'), $request->query->get('start'));
        $draw= $request->query->get('draw');
                  

        // Transforme les données en tableau json
        $data = array();
        foreach ($tests as $test) {
            $data[] = array(
                'idShootingPhoto' => $test->getIdShootingPhoto(),
                'idShootingGalerie' => $test->getIdShootingGalerie(),
                'nomReel' => $test->getNomReel(),
                'idPhoto' => $test->getIdPhoto(),
                'salt' => $test->getSalt(),
                'groupe' => $test->getGroupe(),
                'actif' => $test->getActif(),
                // other fields
            );
        }
    //    return new JsonResponse(json_encode($data));
       return $this->render('admin/pbo/data.html.twig', [
           'datas' => $data,
           'draw' => $draw
       ]);

    }

    /**
     *  @Route("/admin/pbo2", name="adminPBO2", methods={"GET", "POST"})
     */
    public function pbo2(CodePromoRepository $codePromoRepository) {
        return $this->render('admin/pbo/pbo2.html.twig', [
            "CodesPromo" => $codePromoRepository->findAll()
        ]);
    }

 /**
     *  @Route("/admin/pbo3", name="adminPBO3", methods={"GET", "POST"})
     */
    public function pbo3(CodePromoRepository $codePromoRepository, PushNotifierService $pushNotifierService) {
        $pushNotifierService->PushMsg("test Symfony", "cool ça fonctionne", $pushNotifierService::SON_PIANOBAR);
        return $this->render('admin/pbo/pbo2.html.twig', [
            "CodesPromo" => $codePromoRepository->findAll()
        ]);
    }


}


