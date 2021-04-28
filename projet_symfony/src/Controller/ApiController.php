<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    /*
    private $manager;
    private $calendrierRepository;

    public function __construct(EntityManagerInterface $manager, CalendrierRepository $calendrierRepository)
    {
        $this->manager = $manager;
        $this->calendrierRepository = $calendrierRepository;
    }*/

    /**
     * @Route("/api/ctrl", name="calendrier", methods={"GET"})
     */
/*
     public function index2()
     {
        $todos = $this->calendrierRepository->findAll();

        $arraysoftodos = [];

        foreach ($todos as $todo) {
            $arraysoftodos[] = $todo->toArray();
        }
        return $this->render(json($arraysoftodos));
     }*/

    /**
     * @Route("/api/main.css", name="api_css", methods={"GET"})  
     */
}
/*

    /**
     * @Route("/api/main.css", name="api_css")  
=======

    /**
     * @Route("/api/main.css", name="api_css", methods={"GET"})  
>>>>>>> parent of 2d67b37 ( Changes to be committed:)
=======

    /**
     * @Route("/api/main.css", name="api_css", methods={"GET"})  
     *//*

    public function css(): Response
    {
        return $this->render('api/main.css', [
            'controller_name' => 'ApiCSSController',
        ]);
    }
}
*/
?>