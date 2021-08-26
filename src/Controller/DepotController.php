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
    public function createDepot(Request $request)
    {
        $depot = new Depot;
        $requ = json_decode($request->getContent());
        $id = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => ["email" => $request->get('emailAdress')]]);
        //$user = $this->security->getId()->findByOne(['id' => intval(implode($id))]);
        $depot->setIdEleve($id);
        $depot->setTitre("Test"/*$request->get('title')*/);
        $depot->setDescription($request->get('description'));

        //Get file, take name and move it to the storage directory
        //$file = $request->get('file')->getData();
        //$req->handleRequest($request);

        //$file = $req->get("file")->getData();
        $fileName = $request->get("file_name");

        $depot->setFileName("/public/ressources/".$fileName);

        //$file->move($this->getParameter('depot_directory'), $fileName);
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
    * @Route("/ressources", name="get_depot", methods={"GET"})
    */

    public function depotGet()
    {
    
    $user = $this->security->getUser();

    $fichiers = $this->depotRepository->findBy(array('id_eleve' => $user));

    return $this->json($fichiers);
    }
}
