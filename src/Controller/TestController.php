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
use Symfony\Component\Security\Core\Security;

class TestController extends AbstractController
{

    private $calendrierRepository;
    public $name;
    private $security;


    public function __construct(EntityManagerInterface $manager,EntityManagerInterface $entityManager, CalendrierRepository $calendrierRepository, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->manager = $manager;
        $this->calendrierRepository = $calendrierRepository;
        $this->security = $security;
    }

    /**
    *    public function __toString() {
    *        return (string) $this->name;
    *    }
    */

    /**
    * @Route("/dispo", name="api_calendrier", methods={"GET"})
    */

    public function index2(Request $request): Response
    {
    $dispos1 = $this->calendrierRepository->findBy(array('statut'=>'libre'));

    $arraysofdispos1 = [];

    foreach ($dispos1 as $dispo1) {
        $arraysofdispos1[] = $dispo1->toArray();
    }
    return $this->json($arraysofdispos1);
    }

    /**
    * @Route("/api/dispo/user", name="api_user_calendrier", methods={"GET"})
    */

    public function getOccupedDate(Request $request): Response
    {
    $user = $this->security->getUser();

    $dispos1 = $this->calendrierRepository->findBy(['statut'=>'occupé', "id"=> $user]);//["email"=>$user]]);

    $arraysofdispos1 = [];

    foreach ($dispos1 as $dispo1) {
        $arraysofdispos1[] = $dispo1->userDate();
    }
    return $this->json($arraysofdispos1);
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
    $id = $entityManager->getRepository(User::class)->findOneBy(['id'=> $content["id"]]);
    $date = $entityManager->getRepository(Calendrier::class)->find($trueDate);

    if (!$date) {
        throw $this->createNotFoundException(
            'Pas de date trouvée : '. $trueDate
        );
    }
    
    $date->setMatiere($content["matiere"]);
    $date->setStatut($content["statut"]);
    $date->setId($id);

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

    /**
    * @Route("/dispo/{dateId}", name="dispo_delete", methods={"DELETE"})
    * @param $dateId
    */

    public function supprimer($dateId)
    {
        //$content = json_decode($request->getContent(), true);
        $trueDate = date("Y-m-d H:i:s", strtotime($dateId));
        
        $entityManager = $this->getDoctrine()->getManager();
        $date = $entityManager->getRepository(Calendrier::class)->find($trueDate);

        if (!$date) {
            throw $this->createNotFoundException(
                'Pas de date trouvée : '. $trueDate
            );
        }

        try {
            $this->entityManager->remove($date);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            return $this->json([
                $exception
            ]);
        }

        return $this->json([
            'message' => "La plage horaire a été supprimée.",
        ]);       
}
}