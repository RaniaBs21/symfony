<?php

namespace App\Controller;

use App\Entity\QuestionAss;
use App\Form\QuestionAss1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question/ass/front')]
class QuestionAssFrontController extends AbstractController
{
    #[Route('/', name: 'app_question_ass_front_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $questionAsses = $entityManager
            ->getRepository(QuestionAss::class)
            ->findAll();

        return $this->render('question_ass_front/index.html.twig', [
            'question_asses' => $questionAsses,
        ]);
    }

    #[Route('/new', name: 'app_question_ass_front_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $questionAss = new QuestionAss();
        $form = $this->createForm(QuestionAss1Type::class, $questionAss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($questionAss);
            $entityManager->flush();

            return $this->redirectToRoute('app_question_ass_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_ass_front/new.html.twig', [
            'question_ass' => $questionAss,
            'form' => $form,
        ]);
    }

    #[Route('/{idQAss}', name: 'app_question_ass_front_show', methods: ['GET'])]
    public function show(QuestionAss $questionAss): Response
    {
        return $this->render('question_ass_front/show.html.twig', [
            'question_ass' => $questionAss,
        ]);
    }

    #[Route('/{idQAss}/edit', name: 'app_question_ass_front_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuestionAss $questionAss, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuestionAss1Type::class, $questionAss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_question_ass_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_ass_front/edit.html.twig', [
            'question_ass' => $questionAss,
            'form' => $form,
        ]);
    }

    #[Route('/{idQAss}', name: 'app_question_ass_front_delete', methods: ['POST'])]
    public function delete(Request $request, QuestionAss $questionAss, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionAss->getIdQAss(), $request->request->get('_token'))) {
            $entityManager->remove($questionAss);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_question_ass_front_index', [], Response::HTTP_SEE_OTHER);
    }
}
