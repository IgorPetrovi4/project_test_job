<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RoutUserController extends AbstractController
{
    /**
     * @Route("/rout/user", name="rout_user")
     */
    public function index()
    {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            return $this->redirectToRoute('profile');
        }
        return $this->redirectToRoute('profile_edit');
    }


}
