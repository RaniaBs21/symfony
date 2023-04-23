<?php

namespace App\Controller\BackendController;

use App\Entity\ReponseAss;
use App\Form\ReponseAssType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reponse/ass')]
class ReponseAssController extends AbstractController
{
    #[Route('/', name: 'app_reponse_ass_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reponseAsses = $entityManager
            ->getRepository(ReponseAss::class)
            ->findAll();

        return $this->render('reponse_ass/index.html.twig', [
            'reponse_asses' => $reponseAsses,
        ]);
    }

    #[Route('/new', name: 'app_reponse_ass_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reponseAss = new ReponseAss();
        $form = $this->createForm(ReponseAssType::class, $reponseAss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reponseAss);
            $entityManager->flush();

            return $this->redirectToRoute('app_reponse_ass_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse_ass/new.html.twig', [
            'reponse_ass' => $reponseAss,
            'form' => $form,
        ]);
    }

    #[Route('/{idRepAss}', name: 'app_reponse_ass_show', methods: ['GET'])]
    public function show(ReponseAss $reponseAss): Response
    {
        return $this->render('reponse_ass/show.html.twig', [
            'reponse_ass' => $reponseAss,
        ]);
    }

    #[Route('/{idRepAss}/edit', name: 'app_reponse_ass_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReponseAss $reponseAss, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReponseAssType::class, $reponseAss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reponse_ass_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse_ass/edit.html.twig', [
            'reponse_ass' => $reponseAss,
            'form' => $form,
        ]);
    }

    #[Route('/{idRepAss}', name: 'app_reponse_ass_delete', methods: ['POST'])]
    public function delete(Request $request, ReponseAss $reponseAss, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponseAss->getIdRepAss(), $request->request->get('_token'))) {
            $entityManager->remove($reponseAss);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reponse_ass_index', [], Response::HTTP_SEE_OTHER);
    }
}
