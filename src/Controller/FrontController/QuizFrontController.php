<?php

namespace App\Controller\FrontController;

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

    #[Route('/end', name: 'app_end')]
    public function x(): Response
    {
        return $this->redirectToRoute('app_end');
    }
    #[Route('/result', name: 'app_result')]
    public function result(): Response
    {
        return $this->redirectToRoute('app_result');
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


}