<?php
namespace App\Controller\Admin;

use App\Repository\ParamsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ParamsController extends AbstractController
{

    /**
     *  @Route("/admin/params", name="adminParams", methods={"GET"})
     */
    public function params(ParamsRepository $paramsRepository)
    {
        return $this->render('admin/params/params.html.twig', [
            'params' => $paramsRepository->findAll()
        ]);
    }    

    /**
     *  @Route("/admin/params/add", name="adminParamsAdd", methods={"GET"})
     */
    public function paramsAdd(ParamsRepository $paramsRepository)
    {
        dd("ok");
    }

}