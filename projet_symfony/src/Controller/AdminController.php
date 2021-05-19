<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Upload;
use App\Entity\Message;
use App\Form\UploadType;
use App\Form\MessageType;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route("/espace_prof/envoi_fichier", name: "envoi_fichier")]
    public function envoi_fichiers(Request $request, EntityManagerInterface $manager)
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($upload);
            $manager->flush();

            return $this->redirectToRoute('espace_prof');
        }

        return $this->render("./espace_prof/envoi_fichier.html.twig", array(
            'form'=>$form->createView(),
        ));
    }

    #[Route("/espace_prof/messagerie_prof", name: "messagerie_prof")]
    public function messagerie_prof(Request $request, EntityManagerInterface $manager)
    {   
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);

        $messages = $this->getDoctrine()->getRepository(Message::class)->findAll();

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($message);
            $manager->flush();

            return $this->redirectToRoute('espace_prof');
        }

    return $this->render("./espace_prof/messagerie_prof.html.twig", array(
        'form'=>$form->createView(),
        'message'=>$message,
        'messages'=>$messages
    ));
    }
    #[Route("/espace_prof/messagerie_prof/supprimer/{id}", name: "messagerie_prof_supprimer")]
    public function supprimer_message(Message $message)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();

        return $this->redirectToRoute("messagerie_prof");
    }
}
