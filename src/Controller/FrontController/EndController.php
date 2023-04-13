<?php

namespace App\Controller\FrontController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EndController extends AbstractController
{
    #[Route('/end', name: 'end')]
    public function dx(): Response
    {
        return $this->render('home_front/end.html.twig', [
            'controller_name' => 'EndFrontController',
        ]);
    }
}
