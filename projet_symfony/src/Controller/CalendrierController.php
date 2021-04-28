<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CalendrierController extends AbstractController{
    
    /**
     * @Route("/calendrier", name="calendrier")  
     */
    //#[Route('/calendrier', name: 'calendrier')]
    public function calendrier(Request $request, EntityManagerInterface $manager): Response
    {
        return $this->render('./calendrier/calendrier.html.twig', [
            'controller_name' => 'calendrierController'
        ]);
    }    
}
?>