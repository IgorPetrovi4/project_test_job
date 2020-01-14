<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\User;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileEditController extends AbstractController
{
    /**
     * @Route("/profile/edit", name="profile_edit")
     */

    public function index(Request $request, EntityManagerInterface $em)
    {

        // добавление данных
        $form = $this->createForm(ProfileType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile = $form->getData();
            $profile->setIdUser($this->getUser()->addRole('ROLE_ADMIN'));
            $em->persist($profile);
            $em->flush();
            $this->addFlash('success', 'Данные добвленны в базу данных');
            return $this->redirectToRoute('profile');
        }

        $info = "Заполните форму для доступа в профиль";
        return $this->render('profile_edit/index.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView(),
            'info' => $info

        ]);
    }


    /**
     * @Route("profile/edit/{id}", name="edit")
     */
    public function editProfile(Request $request, EntityManagerInterface $em, Profile $profile)
    {

        // форма изменения информации
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();
            $this->addFlash('success', 'Обьект обновлен');
            return $this->redirectToRoute('profile', ['id' => $profile->getId()]);
        }
        $info = "Измените информацию о себе в форме и отправте";
        return $this->render('profile_edit/index.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'info' => $info

        ]);
    }


}
