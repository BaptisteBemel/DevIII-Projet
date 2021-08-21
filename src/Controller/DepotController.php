<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DepotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class DepotController extends AbstractController
{

    private $depotRepository;
    private $security;

    public function __construct(EntityManagerInterface $manager,EntityManagerInterface $entityManager, DepotRepository $depotRepository, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->manager = $manager;
        $this->depotRepository = $depotRepository;
        $this->security = $security;
    }

    #[Route('/depot', name: 'depot')]
    public function index(): Response
    {
        return $this->render('depot/depot.html.twig', [
            'controller_name' => 'DepotController',
        ]);
    }
    /**
     * @Route("/api/depot", name="depot_get")
     */

    public function get_depot(Request $request): Response
    {

    $user = $this->security->getUser();

    $depots = $this->depotRepository->findBy(['id_eleve'=> ["email" => $user], 'is_open' => "true"]);

    $arraysofdepot = [];

        foreach ($depots as $depot) {
            $arraysofdepot[] = $depot->toArray();
        }
    return $this->json($arraysofdepot);
    }

    /**
     * @Route("/api/depot/ajoutDepot", name="depot_post", methods={"POST"})
    * @param Request $request
    * @return JsonResponse
    */

    public function creer_depot(Request $request)
    {
    $content = json_decode($request->getContent());

    $depot = new Depot();

    $depot->setTitre($content);
        //
        try {
            $this->entityManager->persist($depot);
            $this->entityManager->flush();
            return $this->json([
                'depot' => $depot->toArray(),
            ]);
        } catch (Exception $exception) {
            return $this->json([
                $exception
            ]);
        }
    }
}
