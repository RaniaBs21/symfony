<?php

namespace App\Controller;

use App\Entity\ReponseAss;
use App\Form\ReponseAss1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reponse/ass/front')]
class ReponseAssFrontController extends AbstractController
{
    #[Route('/', name: 'app_reponse_ass_front_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reponseAsses = $entityManager
            ->getRepository(ReponseAss::class)
            ->findAll();

        return $this->render('reponse_ass_front/index.html.twig', [
            'reponse_asses' => $reponseAsses,
        ]);
    }

    #[Route('/new', name: 'app_reponse_ass_front_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reponseAss = new ReponseAss();
        $form = $this->createForm(ReponseAss1Type::class, $reponseAss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reponseAss);
            $entityManager->flush();

            return $this->redirectToRoute('app_reponse_ass_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse_ass_front/new.html.twig', [
            'reponse_ass' => $reponseAss,
            'form' => $form,
        ]);
    }

    #[Route('/{idRepAss}', name: 'app_reponse_ass_front_show', methods: ['GET'])]
    public function show(ReponseAss $reponseAss): Response
    {
        return $this->render('reponse_ass_front/show.html.twig', [
            'reponse_ass' => $reponseAss,
        ]);
    }

    #[Route('/{idRepAss}/edit', name: 'app_reponse_ass_front_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReponseAss $reponseAss, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReponseAss1Type::class, $reponseAss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reponse_ass_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse_ass_front/edit.html.twig', [
            'reponse_ass' => $reponseAss,
            'form' => $form,
        ]);
    }

    #[Route('/{idRepAss}', name: 'app_reponse_ass_front_delete', methods: ['POST'])]
    public function delete(Request $request, ReponseAss $reponseAss, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponseAss->getIdRepAss(), $request->request->get('_token'))) {
            $entityManager->remove($reponseAss);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reponse_ass_front_index', [], Response::HTTP_SEE_OTHER);
    }
}
