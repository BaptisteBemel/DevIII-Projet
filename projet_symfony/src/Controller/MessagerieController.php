<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessagerieController extends AbstractController{
    
    /**
     * @Route("/messagerie", name="messagerie")  
     */
    //#[Route('/messagerie', name: 'messagerie')]
    public function messagerie(): Response
    {
        return $this->render('./espace_prof/messagerie.php', [
            'controller_name' => 'messagerieController',
        ]);
    }
}
?>