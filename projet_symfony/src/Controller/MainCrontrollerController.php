<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainCrontrollerController extends AbstractController
{
    #[Route('/', name: 'main_crontroller')]
    public function index(): Response
    {
        return $this->render('./main_crontroller/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/inscription', name:'inscription')]
    public function inscription()
    {
        return $this->render('main_crontroller/inscription.html.twig');
    }

    #[Route('/connexion', name:'connexion')]
    public function connexion()
    {
        return $this->render('main_crontroller/connexion.html.twig');
    }

    #[Route('/connexion/mdp_oublie', name:'mdp_oublie')]
    public function mdp_oublie()
    {
        return $this->render('main_crontroller/mdp_oublie.html.twig');
    }
}
