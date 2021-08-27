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
use Symfony\Component\Filesystem\Filesystem;

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
     * @Route("/api/depot", name="depot_post", methods="POST")
     */
    public function createDepot(Request $request)
    {
        $depot = new Depot;
        $entityManager = $this->getDoctrine()->getManager();

        $requ = json_decode($request->getContent(), true);
        $id = $entityManager->getRepository(User::class)->findOneByEmail($request->get('emailAdress'));
        $depot->setIdEleve($id);
        $depot->setTitre($request->get('title'));
        $depot->setDescription($request->get('description'));

        //Get file, take name and move it to the storage directory
        $file = $request->files->get("file");
        $fileName = $request->get("file_name");
        $depot->setFileName("/ressources/".$fileName);

        $file->move($this->getParameter('depot_directory'), $fileName);
        $this->entityManager->persist($depot);
        $this->entityManager->flush();
        return $this->json([
            'titre' => $depot->toArray(),
        ]);
    }

    /**
<<<<<<< HEAD
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
    * @Route("/ressources", name="ressources_depot", methods={"GET"})
=======
    * @Route("/ressources", name="get_depot", methods={"GET"})
>>>>>>> ebf995e394cd32eeb5c1c11a803f62f68dab26dc
    */

    public function depotGet()
    {
    
    $user = $this->security->getUser();

    $fichiers = $this->depotRepository->findBy(array('id_eleve' => $user));

    return $this->json($fichiers);
    }
}
