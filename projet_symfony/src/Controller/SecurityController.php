<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController {

    #[Route('/connexion', name:'connexion')]
    public function connexion()
    {
        return $this->render('Security/connexion.html.twig');
    }

    #[Route('/connexion/mdp_oublie', name:'mdp_oublie')]
    public function mdp_oublie()
    {
        return $this->render('Security/mdp_oublie.html.twig');
    }
}