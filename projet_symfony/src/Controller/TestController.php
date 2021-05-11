<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\DisponibilitesRepository;
use App\Entity\Calendrier;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    private $calendrierRepository;
    public $name;


    public function __construct(EntityManagerInterface $manager,EntityManagerInterface $entityManager, CalendrierRepository $calendrierRepository)
    {
        $this->entityManager = $entityManager;
        $this->manager = $manager;
        $this->calendrierRepository = $calendrierRepository;
    }

    /**
    *    public function __toString() {
    *        return (string) $this->name;
    *    }
    */

    /**
     * @Route("/api/dispo/get", name="api_calendrier", methods={"GET"})
     */

     public function index2(Request $request): Response
     {
        $dispos = $this->calendrierRepository->findAll(); //pas findAll, juste find date_rdv where statut == libre

        $arraysofdispos = [];

        foreach ($dispos as $dispo) {
            $arraysofdispos[] = $dispo->toArray();
        }
        return $this->json($arraysofdispos);
     }

     /**
      * @Route("/api/dispo/post", name="api_dispo_post", methods={"POST"})
      * @param Request $request
      * @return JsonResponse
      */

      public function create(Request $request)
      {
        $content = json_decode($request->getContent());

        $dispo = new Calendrier();

        $dispo->setDateRdv($content);

        try {
            $this->entityManager->persist($dispo);
            $this->entityManager->flush();
            return $this->json([
                'dispo' => $dispo->toArray(),
            ]);
        } catch (Exception $exception) {
            return $this->json([
                $exception
            ]);
        }
      }
}