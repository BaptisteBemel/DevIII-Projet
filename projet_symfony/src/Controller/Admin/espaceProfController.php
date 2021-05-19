<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class espaceProfController extends AbstractController
{
    #[Route('/espace_prof', name: 'espace_prof')]
    /**
     * @package App\Controller\Admin
     */
    public function index(): Response
    {
        return $this->render('./espace_prof/espace_prof.html.twig');
    }

    #[Route('/espace_prof/profils_eleves', name: 'profils_eleves')]
    public function profils(UserRepository $userRepository): Response
    {
        $profils = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('./espace_prof/profils_eleves.html.twig', ['profils' => $profils]);
    }

    #[Route('/espace_prof/profils_eleves_prenom', name: 'profils_eleves_prenom')]
    public function profilsPrenom(UserRepository $userRepository): Response
    {
        $profils = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('./espace_prof/profils_eleves_prenom.html.twig', ['profils' => $profils]);
    }

    #[Route('/espace_prof/profils_eleves_nom', name: 'profils_eleves_nom')]
    public function profilsNom(UserRepository $userRepository): Response
    {
        $profils = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('./espace_prof/profils_eleves_nom.html.twig', ['profils' => $profils]);
    }

}
