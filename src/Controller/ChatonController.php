<?php

namespace App\Controller;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Chaton", name="chaton_")
 * Class ChatonController
 * @package App\Controller
 */
class ChatonController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function getChatonList(CatRepository $catRepository) {

        $listCar = $catRepository->findAll();

        return $this->render('chaton/index.html.twig', [
            'title' => 'ChatonController',
            'list_cat' => $listCar,
        ]);
    }
}
