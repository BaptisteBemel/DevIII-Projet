<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/user", name="api_user_index")  
     */
    
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        dd($users);

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/main.css", name="api_css")  
     */

    public function css(): Response
    {
        return $this->render('api/main.css', [
            'controller_name' => 'ApiCSSController',
        ]);
    }
}
