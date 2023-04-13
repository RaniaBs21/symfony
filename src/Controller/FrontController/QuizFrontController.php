<?php

namespace App\Controller\FrontController;

use App\Entity\Points;
use App\Entity\Quiz;

use App\Form\QuizType;

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
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('index');
    }


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
    #[Route('/signin', name: 'app_signin')]
    public function signin(): Response
    {
        return $this->render('home_front/signin.html.twig', [
            'controller_name' => 'SignupFrontController',
        ]);
    }
    #[Route('/signup', name: 'app_signup')]
    public function signup(): Response
    {
        return $this->render('home_front/signup.html.twig', [
            'controller_name' => 'SignupFrontController',
        ]);
    }

    #[Route('/play', name: 'app_quiz')]
    public function play(): Response
    {

        return $this->redirectToRoute('quiz');



    }
    #[Route('/resultat', name: 'app_result')]
    public function resultat(): Response
    {

        return $this->redirectToRoute('result');



    }
    #[Route('/quiz', name: 'quiz')]
    public function quizAction(): Response
    {
        $quiz= $this->getDoctrine()->getRepository(Quiz::class)->findAll();
        return $this->render('home_front/quiz.html.twig', [
            'quiz' => $quiz,
        ]);
    }



}