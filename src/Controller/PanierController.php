<?php

namespace App\Controller;

use App\Repository\AccountRepository;
use App\Repository\CatRepository;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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


}
