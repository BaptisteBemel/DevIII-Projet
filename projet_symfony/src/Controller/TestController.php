<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private $manager;
    private $calendrierRepository;

    public function __construct(EntityManagerInterface $manager, CalendrierRepository $calendrierRepository)
    {
        $this->manager = $manager;
        $this->calendrierRepository = $calendrierRepository;
    }

    /**
     * @Route("/api/ctrl", name="calendrier", methods={"GET"})
     */

     public function index2()
     {
        $todos = $this->calendrierRepository->findAll();

        $arraysoftodos = [];

        foreach ($todos as $todo) {
            $arraysoftodos[] = $todo->toArray();
        }
        return $this->json($arraysoftodos);
     }
}