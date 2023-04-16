<?php

namespace App\Controller\FrontController;

use App\Entity\Points;
use App\Entity\QuestionQuiz;
use App\Entity\Quiz;

use App\Form\QuizType;

use App\Form\RechercheType;
use App\Form\UpdateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizFrontController extends AbstractController
{



#[Route('/quiz/userHighScore/{Id}', name: 'quiz_user_high_score')]

    public function getUserHighScore(int $Id, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Points::class);
        $query = $repository->createQueryBuilder('s')
            ->select('MAX(s.score) as highScore')
            ->where('s.id = :Id')
            ->setParameter('Id', $Id)
            ->getQuery();

        $highScore = $query->getSingleScalarResult();

        return $this->render('quiz/result.html.twig', ['highScore' => $highScore]);
    }

#[Route('/quiz/saveScore/{id}/{score}', name:'quiz_save_score')]

   public function saveScore(int $Id, int $score, EntityManagerInterface $entityManager): Response
        {
            $scoreEntity = new Points();
            $scoreEntity->setId($Id);
            $scoreEntity->setScore($score);

            $entityManager->persist($scoreEntity);
            $entityManager->flush();

            return $this->redirectToRoute('quiz_save_score', ['id' => $Id]);
        }


    #[Route('/play', name: 'app_quiz')]
    public function play(): Response
    {

        return $this->redirectToRoute('play');
    }
    #[Route('/resultat', name: 'app_result')]
    public function resultat(): Response
    {

        return $this->redirectToRoute('result');



    }
    #[Route('/front', name: 'front_question')]
    public function quizAction(): Response
    {
        $question_quizzes= $this->getDoctrine()->getRepository(QuestionQuiz::class)->findAll();
        return $this->render('home_front/index1.html.twig', [
            'question_quizzes' => $question_quizzes,
        ]);
    }
    /**
     * @Route("/rechercheQ/", name="Question_par_desc")
     * Method({"GET"})
     */
    public function QuestionPardesc(Request $request){

        $question = new QuestionQuiz();
        $form = $this->createForm(RechercheType::class,$question);
        $form->handleRequest($request);

        $articles= [];

        if($form->isSubmitted() && $form->isValid()) {
            $descQuestion = $question->getDescQuestion();


            $articles= $this->getDoctrine()->getRepository(QuestionQuiz::class)->findOneBydescQuestion($descQuestion);
        }

        return  $this->render('home_front/find.html.twig',[ 'form' =>$form->createView(), 'question_quiz' => $question]);
    }

}