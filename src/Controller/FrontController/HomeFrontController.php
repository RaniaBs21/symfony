<?php

namespace App\Controller\FrontController;

use App\Entity\QuestionQuiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeFrontController extends AbstractController

{
    #[Route('/home/front', name: 'app_home_front')]
    public function index(): Response
    {
        return $this->render('home_front/basefront.html.twig', [
            'controller_name' => 'HomeFrontController',
        ]);
    }


        #[Route('/index', name: 'app_index')]
    public function c(): Response
    {
        return $this->render('home_front/index.html.twig', [
            'controller_name' => 'HomeFrontController',
        ]);
    }

    #[Route('/play', name: 'play')]
    public function play(): Response
    {

        return $this->render('home_front/quiz.html.twig', [
            'controller_name' => 'QuizFrontController',
        ]);


    }
}
