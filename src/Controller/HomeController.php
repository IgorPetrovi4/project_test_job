<?php

namespace App\Controller;


use FOS\UserBundle\Controller\SecurityController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends SecurityController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
            ]);



    }

}
