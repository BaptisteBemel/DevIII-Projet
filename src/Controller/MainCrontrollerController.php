<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class MainCrontrollerController extends AbstractController
{
    /**
     * @Route("/", name="main_crontroller")  
     */
    //#[Route('/', name: 'main_crontroller')]
    public function index(): Response
    {
        return $this->render('./main_crontroller/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}

