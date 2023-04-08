<?php

namespace App\Controller\FrontController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizFrontController extends AbstractController
{
    #[Route('/index', name: 'wd')]
    public function index(): Response
    {
        return $this->render('home_front/index.html.twig', [
            'controller_name' => 'QuizFrontController',
        ]);
    }
    #[Route('/play', name: 'front')]
    public function a(): Response
    {
        return $this->render('home_front/quiz.html.twig', [
            'controller_name' => 'QuizFrontController',
        ]);
    }


}