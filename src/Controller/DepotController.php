<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DepotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Depot;
use App\Form\DepotType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;

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
     * @Route("/api/depot/ajoutDepot", methods="POST")
     */
    public function createDepot(Request $request, $file)
    {
        $depot = new Depot;
        $entityManager = $this->getDoctrine()->getManager();

        $requ = json_decode($request->getContent(), true);
        $id = $entityManager->getRepository(User::class)->findOneBy(['id' => ["email" => $requ['emailAdress']]]);
        //$user = $this->security->getId()->findByOne(['id' => intval(implode($id))]);
        $depot->setIdEleve($id);
        $depot->setTitre($requ['title']);
        $depot->setDescription($requ['description']);

        //Get file, take name and move it to the storage directory
        //$file = $requ['file'];
        //$req->handleRequest($request);

        //$file = $req->get("file")->getData();
        $file = $request->files->all();
        $fileName = $requ["file_name"];

        $depot->setFileName("/ressources/".$fileName);

        $file[0]->move($this->getParameter('depot_directory'), $fileName);
        $this->entityManager->persist($depot);
        $this->entityManager->flush();
        return $this->json([
            'titre' => $depot->toArray(),
        ]);
    }

    /**
     * @Route("/depot/SSJAOI", name="depot_post")
     */
    /*
    public function new(Request $request, SluggerInterface $slugger)
    {
        $depot = new Depot();
        $form = $this->createForm(DepotType::class, $depot);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $form->$depot->getFileName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('depot_repository'), $fileName);
            $depot->setFileName($fileName);
            
            return $depot->setFileName($newFilename);
        }

        return $this->render('depot/depot.html.twig', [
            'form' => $form->createView(),
        ]);
    }*/

    /**
     * @Route("/api/depot", name="depot_get")
     */
    /*
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
    */
}
