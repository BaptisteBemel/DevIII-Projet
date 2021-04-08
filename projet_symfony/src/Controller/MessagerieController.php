<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessagerieController extends AbstractController{
    
    /**
     * @Route("/messagerie", name="messagerie", methods={"GET"})  
     */
    //#[Route('/messagerie', name: 'messagerie')]
    public function messagerie(): Response
    {
        return $this->render('./messagerie/messagerie.html', [
            'controller_name' => 'messagerieController',
        ]);
    }
}
?>