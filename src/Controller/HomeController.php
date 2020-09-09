<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="Pages")
     */
    public function index()
    {
        return $this->render('home/home.html.twig', [
            'title' => 'HomeController',
        ]);
    }
}
