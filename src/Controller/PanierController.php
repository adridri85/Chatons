<?php

namespace App\Controller;

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
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render("panier/panier.html.twig");
    }

    
}
