<?php

namespace App\Controller;

use App\Controller\AdminController;
use App\Entity\User;
use App\Repository\CalendrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Calendrier;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AjoutDispoGetallPostController extends AbstractController
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
    * @Route("/all", name="api_dispo_post_verif", methods={"GET"})
    */

    public function all(Request $request): Response
    {
    $dispos1 = $this->calendrierRepository->findAll();

    $arraysofdispos1 = [];

    foreach ($dispos1 as $dispo1) {
        $arraysofdispos1[] = $dispo1->toArray();
    }
    return $this->json($arraysofdispos1);
    }

    /**
    * @Route("/reservations", name="api_dispo_post_verif", methods={"GET"})
    */

    public function reservations(Request $request): Response
    {
    $dispos1 = $this->calendrierRepository->findBy(array('statut'=>'occupé'));

    $arraysofdispos1 = [];

    foreach ($dispos1 as $dispo1) {
        $arraysofdispos1[] = $dispo1->getRdv();
    }
    return $this->json($arraysofdispos1);
    }
}