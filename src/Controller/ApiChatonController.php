<?php

namespace App\Controller;

use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/apiChaton/v1/chaton", name="chathon_api_v1_")
 * Class ApiChatonController
 * @package App\Controller
 */
class ApiChatonController extends AbstractController
{
    /**
     * @Route("/search/{name}", name="recherche_par_nom")
     */
    public function getCatsByName($name,CatRepository $catRepository)
    {

        $cat = $catRepository->findCatByName($name);


        return new JsonResponse([
            'ListCat' => $cat,
        ]);
    }
}
