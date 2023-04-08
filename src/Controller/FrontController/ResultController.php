<?php

namespace App\Controller\FrontController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    #[Route('/result', name: 'app_result')]
    public function index(): Response
    {
        return $this->render('home_front/result.html.twig', [
            'controller_name' => 'ResultController',
        ]);
    }
}
