<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Exception;
use App\Entity\Disponibilites;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\DisponibilitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private $manager;
    private $calendrierRepository;
    private $disponibilitesRepository;

    public function __construct(EntityManagerInterface $manager, CalendrierRepository $calendrierRepository, DisponibilitesRepository $disponibilitesRepository)
    {
        $this->manager = $manager;
        $this->calendrierRepository = $calendrierRepository;
        $this->disponibilitesRepository = $disponibilitesRepository;
    }

    /**
     * @Route("/api/ctrl", name="api_calendrier", methods={"GET"})
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

     /**
      * @Route("/api/dispo/post", name="api_dispo_post", methods={"POST"})
      * @param Request $request
      * @return JsonResponse
      */

      public function create(Request $request)
      {
          $content = json_decode($request->getContent());
          
          $dispo = new Disponibilites();

          $dispo->setName($content->name); //setname error

          try {
            $this->entityManager->persist($dispo);
            $this->entityManager->flush();
            return $this->json([
                'todo' => $dispo->toArray(),
            ]);
          } catch (Exception $exception) {
              //error
          }
      }
}