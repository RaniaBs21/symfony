<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participation;
use App\Entity\Admin;
use App\Repository\EvenementRepository;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface ;
class EventFrontController extends AbstractController
{
    /*#[Route('/event/front', name: 'app_event_front')]
    public function index(EvenementRepository $evenementRepository,PaginatorInterface $paginator): Response
    {
        $evenements = $evenementRepository->findAll();
        // Paginer la liste des evenements
        $EvPaginated = $paginator->paginate(
            $evenements,
            $request->query->getInt('page', 1),
            4 // Nombre d'éléments par page
        );

        return $this->render('event_front/index.html.twig', [
            'evenements' => $EvPaginated,
        ]);
        
    }*/
    #[Route('/event/front', name: 'app_event_front')]
public function index(EvenementRepository $evenementRepository, PaginatorInterface $paginator, Request $request): Response
{
    $evenements = $evenementRepository->findAll();
    // Paginer la liste des evenements
    $EvPaginated = $paginator->paginate(
        $evenements,
        $request->query->getInt('page', 1),
        4 // Nombre d'éléments par page
    );

    return $this->render('event_front/index.html.twig', [
        'evenements' => $EvPaginated,
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
    /*
    #[Route('/event/front/{idEv}/image', name: 'app_event_image', methods: ['GET'])]   
    public function displayImageAction($idEv)
    {
        $event = $this->getDoctrine()->getRepository(Evenement::class)->find($idEv);

        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        }

        $imageData = $event->getImageEv();

        $response = new BinaryFileResponse(stream_get_contents($imageData));
        $response->headers->set('Content-Type', 'image/png');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE);

        return $response;
    }*/
    /**
    * @Route("/event/front/{idEv}/participate", name="app_event_participate")
    */
    /*public function participateAction(Request $request, $idEv, MailerService $mailer)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository(Evenement::class)->find($idEv);
        $idUt = 2; // ID de l'objet Admin à récupérer
        $adminRepository = $em->getRepository(Admin::class);
        $admin = $adminRepository->find($idUt);
        $participation = $em->getRepository(Participation::class)->findBy([
            //'idU' => $this->getUser(),
            'idU' => $admin,
            'idEv' => $event,
            ]);
        
        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        } elseif($participation) {
            $this->addFlash('warning', 'Vous participez déjà à cet événement.');
            //return $this->redirectToRoute('app_event_show', ['idEv' => $idEv]);
        } else{


        /*$idUt = 2; // ID de l'objet Admin à récupérer
        $adminRepository = $entityManager->getRepository(Admin::class);
        $admin = $adminRepository->find($idUt);

        $participation = new Participation();
        $participation->setIdU($admin);
        $participation->setIdEv($event);
        $participation->setDateParticipation(new \DateTime());

        $event->setNbrePlaces($event->getNbrePlaces() - 1);

        $entityManager->persist($participation);
        $entityManager->persist($event);
        $entityManager->flush();*/

    /*    $participation = new Participation();
        $participation->setIdU($admin);
        //$participation->setIdU($this->getUser());
        $participation->setIdEv($event);
        $participation->setDateParticipation(new \DateTime());

        $event->setNbrePlaces($event->getNbrePlaces() - 1);

        $em->persist($participation);
        $em->persist($event);
        $em->flush();

        /*$em->persist($participation);
        $em->flush();*/
    /*    $mailMessage = 'Bonjour'.' '.$admin->getNomU().' '.$admin->getPrenomU().' '.'Vous êtes inscrit à l\'événement '. ' '.$event->getTitreEv();
        $mailer->sendEmail(content: $mailMessage);
        $this->addFlash('success', 'Vous êtes inscrit à l\'événement '.$event->getTitreEv());
        
        //return $this->redirectToRoute('app_event_front');
        }
        return $this->redirectToRoute('app_event_front');
    }
    */

    /**
 * @Route("/event/front/{idEv}/participate", name="app_event_participate")
 */
    public function participateAction(Request $request, $idEv, MailerService $mailer)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository(Evenement::class)->find($idEv);
        $idUt = 2; // ID de l'objet Admin à récupérer
        $adminRepository = $em->getRepository(Admin::class);
        $admin = $adminRepository->find($idUt);
        //$admin = $this->getUser(); // Utilise l'utilisateur connecté comme admin
        $participation = $em->getRepository(Participation::class)->findOneBy([
            'idU' => $admin,
            'idEv' => $event,
        ]);

        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        } elseif($participation) {
            $this->addFlash('warning', 'Vous participez déjà à cet événement.');
        } else {
            $participation = new Participation();
            $participation->setIdU($admin);
            $participation->setIdEv($event);
            $participation->setDateParticipation(new \DateTime());

            $event->setNbrePlaces($event->getNbrePlaces() - 1);

            $em->persist($participation);
            $em->persist($event);
            $em->flush();

            $mailMessage = 'Bonjour'.' '.$admin->getNomU().' '.$admin->getPrenomU().' '.'Vous êtes inscrit à l\'événement '. ' '.$event->getTitreEv();
            
            $mailer->sendEmail($mailMessage);
            $this->addFlash('success', 'Vous êtes inscrit à l\'événement '.$event->getTitreEv());
        }
        
        return $this->redirectToRoute('app_event_front');
    }
    #[Route('/evenementshow/{id}', name: 'evenement_show')]
    public function showphoto(Evenement $evenement): Response
    {
        $photo = stream_get_contents($evenement->getImageEv());

        return new Response($photo, 200, ['Content-Type' => 'image/jpeg']);
    }
    
    #[Route('/event/front/filter', name: 'app_event_filter', methods: ['GET'])]
    public function filterByRegionAndCategory(Request $request)
    {
        $region = $request->query->get('region');
        $categorie = $request->query->get('categorie');

        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->createQueryBuilder('e')
            ->where('e.regionEv = :region')
            ->andWhere('e.categorieEv = :categorie')
            ->setParameter('region', $region)
            ->setParameter('categorie', $categorie)
            ->getQuery()
            ->getResult();

        return $this->render('evenements.html.twig', [
            'evenements' => $evenements,
        ]);
        return $this->render('event_Front/index.html.twig', [
            'evenement' => $evenement,
        ]);
    }
 
}