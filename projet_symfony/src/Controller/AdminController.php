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
    #[Route("/espace_prof/utilisateurs", name: "admin_utilisateurs")]
    public function usersList(UserRepository $users)
    {
    return $this->render('admin/users.html.twig', [
        'users' => $users->findAll(),
    ]);
    }

    #[Route("/espace_prof/utilisateurs/modifier/{id}", name: "admin_modifier_utilisateur")]
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

    /**
     * @param User $user
     * @return RedirectResponse
     */
    #[Route("/espace_prof/utilisateurs/supprimer/{id}", name: "admin_supprimer_utilisateur")]
    public function supprimer_utilisateur(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("admin_utilisateurs");
    }

    #[Route("/espace_prof/administration_site", name: "administration_site")]
    public function adminSite(){
        return $this->render('./admin/edit_site.html.twig');
    }
}
