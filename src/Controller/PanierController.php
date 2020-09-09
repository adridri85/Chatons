<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\CatRepository;
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
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render("panier/panier.html.twig");
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
