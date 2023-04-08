<?php

namespace App\Controller\FrontController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EndController extends AbstractController
{
    #[Route('/end', name: 'app_end')]
    public function index(): Response
    {
        return $this->render('home_front/end.html.twig', [
            'controller_name' => 'EndController',
        ]);
    }
}
