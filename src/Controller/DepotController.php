<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepotController extends AbstractController
{
    #[Route('/depot', name: 'depot')]
    public function index_prof(): Response
    {
        return $this->render('depot/depot.html.twig', [
            'controller_name' => 'DepotController',
        ]);
    }
}
