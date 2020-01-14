<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        //Вывод по id
        $table = $em->getRepository(Profile::class)->findBy(array(
            'id_user' => $this->getUser()->getId(),
        ));


        // вывод всей таблицы
        $users = $em->getRepository(Profile::class)->findBy([]);
        if (empty($table)) {

            return $this->redirectToRoute('profile_edit');
        }

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'tables' => $table,
            'users' => $users
        ]);
    }


    /**
     * @Route("profile/user{id}", name="profile_user")
     */
    public function viewProfile(EntityManagerInterface $em, Profile $profile)
    {


        //Вывод по id route
        $user1 = $em->getRepository(Profile::class)->findBy(array(
            'id' => $profile->getId()
        ));

        return $this->render('profile_id/index.html.twig', [
            'user1' => $user1

        ]);
    }


}
