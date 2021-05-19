<?php

namespace App\Controller;

use App\Entity\Upload;
use App\Entity\Message;
use App\Form\MessageType;
use App\Form\EditProfileType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class espaceEleveController extends AbstractController
{
    #[Route('/espace_eleve', name: 'espace_eleve')]
    public function index(): Response
    {
        return $this->render('./espace_eleve/espace_eleve.html.twig');
    }

    #[Route('/espace_eleve/profil_eleve', name: 'profil_eleve')]
    public function profil(): Response
    {
        return $this->render('./profil_eleve/profil_eleve.html.twig');
    }

    #[Route('/espace_eleve/profil_eleve/modif_profil', name: 'modif_profil')]
    public function edit_profil(Request $request): Response
    {   
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('profil_eleve');
        }

        return $this->render('./espace_eleve/modif_prof.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/espace_eleve/profil_eleve/modif_mdp', name: 'modif_mdp')]
    public function edit_mdp(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('post')){
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            if($request->request->get('pass') == $request->request->get('pass2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                $em->flush();
                $this->addFlash("message", "Mot de Passe mis à jour !");

                return $this->redirectToRoute("profil_eleve");
            }
            else{
                $this->addFlash("error", "Veuillez entrer deux fois le même mot de passe !");
            }
        }

        return $this->render('./espace_eleve/modif_mdp.html.twig');
    }

    #[Route('/espace_eleve/ressources', name: 'ressources')]
    public function recup_fichier()
    {
        $ressources = $this->getDoctrine()->getRepository(Upload::class)->findAll();

        return $this->render("espace_eleve/ressources.html.twig", [
            'ressources'=>$ressources]);
    }

    #[Route('/espace_eleve/messagerie_eleve', name: 'messagerie_eleve')]
    public function messagerie_eleve(Request $request, EntityManagerInterface $manager){
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);

        $messages = $this->getDoctrine()->getRepository(Message::class)->findAll();

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($message);
            $manager->flush();

            return $this->redirectToRoute('espace_eleve');
        }

    return $this->render("./espace_eleve/messagerie_eleve.html.twig", array(
        'form'=>$form->createView(),
        'message'=>$message,
        'messages'=>$messages
    ));
    }

    #[Route("/espace_eleve/messagerie_eleve/supprimer/{id}", name: "messagerie_eleve_supprimer")]
    public function supprimer_message(Message $message)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();

        return $this->redirectToRoute("messagerie_eleve");
    }
}