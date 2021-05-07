<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class commentaireController extends AbstractController{
    /**
     * @Route("/commentaires", name="commentaires")  
     */
    //#[Route('/commentaires', name: 'commentaires')]
    public function comment(Request $request, EntityManagerInterface $manager): Response
    {   
        $user = new User();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime());

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('commentaires');
        }
        
        $commentaires = $this->getDoctrine()->getRepository(Comment::class)->findAll();

        return $this->render("commentaires/commentaires.html.twig", [
            'commentForm'=>$form->createView(),
            'commentaires'=>$commentaires,
            'utilisateur'=>$user
        ]);
    }

    #[Route("/commentaires/supprimer/{id}", name: "admin_supprimer_commentaire")]
    public function supprimer_commentaire(Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute("commentaires");
    }
}