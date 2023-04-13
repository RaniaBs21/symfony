<?php

namespace App\Controller\FrontController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementFrontController extends AbstractController
{
    #[Route('/evenement/front', name: 'app_evenement_front')]
    public function index(): Response
    {
        return $this->render('evenement_front/index.html.twig', [
            'controller_name' => 'EvenementFrontController',
        ]);
    }
}
