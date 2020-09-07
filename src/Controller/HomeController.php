<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/home", name="Home_")
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Pages")
     */
    public function index()
    {
        return $this->render('home/home.html.twig', [
            'title' => 'HomeController',
        ]);
    }
}
