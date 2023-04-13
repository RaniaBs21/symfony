<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class EventFrontController extends AbstractController
{
    #[Route('/event/front', name: 'app_event_front')]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findAll();
        return $this->render('event_front/index.html.twig', [
            'evenements' => $evenements,
        ]);
        
    }
    /*
    #[Route('/event/front', name: 'app_event_front')]
    public function index(EvenementRepository $evenementRepository, EntityManagerInterface $entityManager): Response
    {
        // Récupérer les événements avec les données de la relation "Participer"
        $evenements = $evenementRepository->createQueryBuilder('e')
            ->leftJoin(Participer::class, 'p', 'WITH', 'p.idEv = e.idEv')
            ->getQuery()
            ->getResult();
           // Récupérer les événements avec les données de la relation "Participer"
        $evenements = $entityManager->createQueryBuilder()
        ->select('e, p')
        ->from(Evenement::class, 'e')
        ->leftJoin(Participer::class, 'p', 'WITH', 'p.idEv = e.idEv')
        ->getQuery()
        ->getResult();

        return $this->render('event_front/index.html.twig', [
            'evenements' => $evenements,
        ]);
        

    } */


    #[Route('/{idEv}', name: 'app_event_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('event_Front/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }
    
    public function displayImageAction($eventId)
    {
        $event = $this->getDoctrine()->getRepository(Evenement::class)->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        }

        $imageData = $event->getImageData();

        $response = new BinaryFileResponse(stream_get_contents($imageData));
        $response->headers->set('Content-Type', 'image/png');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE);

        return $response;
    }
}