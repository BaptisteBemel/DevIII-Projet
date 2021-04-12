<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class espaceProfController extends AbstractController
{
    #[Route('/espace_prof', name: 'espace_prof')]
    public function index(): Response
    {
        return $this->render('./espace_prof/espace_prof.html.twig');
    }

    #[Route('/profils_eleves', name: 'profils_eleves')]
    public function profils(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        $profils = $this->json($users, 200, []);

        return $this->render('./espace_prof/profils_eleves.html.twig', ['profils' => $profils]);
    }
}