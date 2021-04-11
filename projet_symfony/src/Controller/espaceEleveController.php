<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class espaceEleveController extends AbstractController
{
    #[Route('/espace_eleve', name: 'espace_eleve')]
    public function index(): Response
    {
        return $this->render('./espace_eleve/espace_eleve.html.twig');
    }

    #[Route('/profil_eleve', name: 'profil_eleve')]
    public function profil(): Response
    {
        return $this->render('./profil_eleve/profil_eleve.html.twig');
    }

    #[Route('/modif_profil', name: 'modif_profil')]
    public function edit_profil(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('commmentaires');
        }

        return $this->render('modif_profil/modif_profil.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}