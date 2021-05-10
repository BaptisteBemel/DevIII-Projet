<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

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

}