<?php

namespace App\Controller;

use App\Controller\AdminController;
use App\Entity\User;
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
        $dispos = $this->calendrierRepository->findBy(array('statut'=>'libre'));

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
      /**
      * @Route("/api/dispo/put/{dateId}", name="api_dispo_eleve_post", methods={"PUT"})
      * @param Request $request
      * @return JsonResponse
      */

      public function inscrire(Request $request, $dateId)
      {
        $content = json_decode($request->getContent(), true);
        $trueDate = date("Y-m-d H:i:s", strtotime($dateId));
        
        $entityManager = $this->getDoctrine()->getManager();
        $date = $entityManager->getRepository(Calendrier::class)->find($trueDate);

        if (!$date) {
            throw $this->createNotFoundException(
                'Pas de date trouvée : '. $trueDate
            );
        }
        
        $date->setMatiere($content["matiere"]);
        $date->setStatut($content["statut"]);
        //$date->setId($content["id"]);

        try {
            $this->entityManager->flush();
            
        } catch (Exception $exception) {
            return $this->json([
                $exception
            ]);
        }
        return $this->json([
                'message' => "La date a été inscrite !",
            ]);
      }
}