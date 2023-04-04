<?php

namespace App\Controller\BackendController;

use App\Entity\Sujet;
use App\Entity\Topic;
use App\Entity\Commentaire;
use App\Form\SujetType;
use App\Form\TopicType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'post')]
    public function post(): Response
    {
        return $this->render('post/components-post.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/home', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/base.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/evenement', name: 'evenement')]
    public function evenement(): Response
    {
        return $this->render('evenement/components-evenement.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }
    #[Route('/assistance', name: 'assistance')]
    public function assistance(): Response
    {
        return $this->render('assistance/components-assistance.html.twig', [
            'controller_name' => 'AssistanceController',
        ]);
    }
    #[Route('/cours', name: 'cours')]
    public function cours(): Response
    {
        return $this->render('cours/components-cours.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }
    #[Route('/produit', name: 'produit')]
    public function produit(): Response
    {
        return $this->render('produit/components-produits.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    #[Route('/quiz', name: 'quiz')]
    public function quiz(): Response
    {
        return $this->render('quiz/components-quiz.html.twig', [
            'controller_name' => 'QuizController',
        ]);
    }
    #[Route('/user', name: 'user')]
    public function user(): Response
    {
        return $this->render('user/components-user.html.twig', [
            'controller_name' => 'UserController',
        ]);

    }
    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('user/register.html.twig', [
            'controller_name' => 'UserController',
        ]);

    }
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('user/login.html.twig', [
            'controller_name' => 'UserController',
        ]);

    }

    /************************* Affichage Sujet **************************************/

    #[Route('/post/sujet', name: 'listpost')]
    public function listpost(ManagerRegistry $doctrine): Response
    {
        $Sujetrepository=$doctrine->getRepository(Sujet::class);
        $sujets=$Sujetrepository->findAll();
        return $this->render('post/afficherPost.html.twig', [
            'sujets' => $sujets,
        ]);
    }
    /************************* Suppression Sujet**************************************/

 /*   #[Route('/post', name: 'DeleteSujet')]
    public function deleteSujet($idsujet, ManagerRegistry $doctrine): Response
    {
        //Trouver le bon Classroom
        $repoS = $doctrine->getRepository(Sujet::class);
        $sujet= $repoS->find($idsujet);
        //Utiliser Manager pour supprimer le classroom trouvé
        $em= $doctrine->getManager();
        $em->remove($sujet);
        $em->flush();

        return $this->redirectToRoute('listpost');
    }
*/
    /************************* Affichage topic **************************************/

    #[Route('/post', name: 'listtopic')]
    public function listTopic(ManagerRegistry $doctrine): Response
    {
        $Topicrepository=$doctrine->getRepository(Topic::class);
        $topics=$Topicrepository->findAll();
        return $this->render('post/components-post.html.twig', [
            'topics' => $topics,
        ]);
    }

 /************************* Suppression topic **************************************/
    #[Route('/post', name: 'DeleteTopic')]
    public function deleteTopic($idtopic, ManagerRegistry $doctrine): Response
    {
        //Trouver le bon Classroom
        $repoT = $doctrine->getRepository(Sujet::class);
        $topic= $repoT->find($idtopic);
        //Utiliser Manager pour supprimer le classroom trouvé
        $em= $doctrine->getManager();
        $em->remove($topic);
        $em->flush();

        return $this->redirectToRoute('listtopic');
    }

    /** ********************************* update topic ********************************/
    #[Route('/updatetopic/{idtopic}', name: 'updateTopic')]
    public function updateTopic(Request $request,ManagerRegistry $doctrine,Topic $topic)
    {
        
        $form=$this->createForm(TopicType::class, $topic);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
 
        if ($form->isSubmitted()) {
        $em= $doctrine->getManager();
        $entityManager =$doctrine->getManager();
        $entityManager->flush();
        
        return $this->redirectToRoute('listtopic',['idtopic' =>$topic->getIdtopic()]);
        }
        return $this->render('post/updateTopic.html.twig', [
            'form'=> $form->createView(),
        ]);
    }

    /************************* Affichage commentaire **************************************/

    #[Route('/post/sujet/commentaire', name: 'listcom')]
    public function listCommentaire(ManagerRegistry $doctrine): Response
    {
        $Commentairerepository=$doctrine->getRepository(Commentaire::class);
        $commentaires=$Commentairerepository->findAll();
        return $this->render('post/afficherCom.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }
  /************************* Ajout post **************************************/
    #[Route('/post/sujet/add', name: 'addPost')]
    public function ajout(ManagerRegistry $doctrine, Request $request): Response
    {
        $sujet= new Sujet;
        $form=$this->createForm(SujetType::class, $sujet);
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
        $em= $doctrine->getManager();
        $em->persist($sujet);
        $em->flush();
        return $this->redirectToRoute('addPost');
        }
        return $this->render('post/addSujet.html.twig', [
            'formSujet'=> $form->createView(),
        ]);
    
        }

          /************************* Ajout Topic **************************************/
    #[Route('/post/add', name: 'addTopic')]
    public function addTopic(ManagerRegistry $doctrine, Request $request): Response
    {
        $topic= new Topic;
        $form=$this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
        $em= $doctrine->getManager();
        $em->persist($topic);
        $em->flush();
        return $this->redirectToRoute('addTopic');
        }
        return $this->render('post/addTopic.html.twig', [
            'formTopic'=> $form->createView(),
        ]);
    
        }
}
