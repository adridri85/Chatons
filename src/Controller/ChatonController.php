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

    /**
     * @Route("/detail/{id}", name="detailByid")
     */
    public function getCatById($id, CatRepository $catRepository){

        $catbyId = $catRepository->findBy(array('id' => $id));

        return $this->render('chaton/detail.html.twig',[
            'detailId' => $catbyId,
        ]);
    }
}
