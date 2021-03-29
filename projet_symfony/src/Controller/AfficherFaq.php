<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AfficherFaq extends AbstractController{
    #[Route('/faq', name: 'faq')]
    public function faq(): Response
    {
        return $this->render("faq/faq.html.twig");
    }
}