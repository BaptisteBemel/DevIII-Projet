<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalAppController extends AbstractController{
    
    /**
     * @Route("/calendrier/App.js", name="calendrierapp")  
     */
    //#[Route('/calendrier/App.js', name: 'calendrierapp')]
    public function calapp(): Response
    {
        return $this->render('./calendrier/App.js', [
            'controller_name' => 'calappController',
        ]);
    }
}
?>