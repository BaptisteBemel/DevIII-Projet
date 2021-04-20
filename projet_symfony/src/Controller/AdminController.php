<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route("/admin/utilisateurs", name: "admin_utilisateurs")]
    public function usersList(UserRepository $users)
    {
    return $this->render('admin/users.html.twig', [
        'users' => $users->findAll(),
    ]);
    }

    #[Route("/admin/utilisateurs/modifier/{id}", name: "admin_modifier_utilisateur")]
    public function editUser(User $user, Request $request){
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès !');
            return $this->redirectToRoute('admin_utilisateurs');
        }

        return $this->render('admin/edit_user.html.twig',
            ['userForm' => $form->createView(),
        ]);
    }

}
