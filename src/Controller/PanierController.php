<?php

namespace App\Controller;


use App\Repository\AccountRepository;
use App\Repository\CatRepository;
use App\Repository\PanierRepository;
use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @Route("/panier", name="panier_")
 * Class PanierController
 * @package App\Controller
 */
class PanierController extends AbstractController
{
    /**
     * @Route("/", name="view")
     */
    public function index(PanierRepository $panierRepository)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $panier = $panierRepository->fingAllPanier($this->getUser()->getId());

        dd($panier);

        return $this->render("panier/panier.html.twig",[
            'myPanier' => $panier
        ]);
    }

    /**
     * @Route("/new/{id}", name="addCat")
     */
    public function getInsertCatsOnPannier(EntityManagerInterface $entityManager, Request $request,CatRepository $catRepository,$id){

        $cat = $catRepository->find(array('id' => $id ));

        $panier = new Panier();

        $panier->setAccount($this->getUser());
        $panier->addCat($cat);

        $entityManager->persist($panier);
        $entityManager->flush();


        return $this->redirectToRoute("panier_view");


    }
}
