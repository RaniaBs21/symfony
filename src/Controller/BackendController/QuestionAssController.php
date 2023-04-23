<?php

namespace App\Controller\BackendController;

use App\Entity\QuestionAss;
use App\Form\QuestionAssType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question/ass')]
class QuestionAssController extends AbstractController
{

  
    
    #[Route('/', name: 'app_question_ass_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $questionAsses = $entityManager
            ->getRepository(QuestionAss::class)
            ->findAll();

        return $this->render('question_ass/index.html.twig', [
            'question_asses' => $questionAsses,
        ]);
    }

    #[Route('/new', name: 'app_question_ass_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $questionAss = new QuestionAss();
        $form = $this->createForm(QuestionAssType::class, $questionAss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($questionAss);
            $entityManager->flush();

            return $this->redirectToRoute('app_question_ass_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_ass/new.html.twig', [
            'question_ass' => $questionAss,
            'form' => $form,
        ]);
    }

    #[Route('/{idQAss}', name: 'app_question_ass_show', methods: ['GET'])]
    public function show(QuestionAss $questionAss): Response
    {
        return $this->render('question_ass/show.html.twig', [
            'question_ass' => $questionAss,
        ]);
    }

    #[Route('/{idQAss}/edit', name: 'app_question_ass_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuestionAss $questionAss, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuestionAssType::class, $questionAss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_question_ass_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_ass/edit.html.twig', [
            'question_ass' => $questionAss,
            'form' => $form,
        ]);
    }

    #[Route('/{idQAss}', name: 'app_question_ass_delete', methods: ['POST'])]
    public function delete(Request $request, QuestionAss $questionAss, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionAss->getIdQAss(), $request->request->get('_token'))) {
            $entityManager->remove($questionAss);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_question_ass_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/search', name: 'app_question_ass_search', methods: ['GET', 'POST'])]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeQAss = $request->query->get('typeQAss');
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
    
        $questionAsses = $entityManager
            ->getRepository(QuestionAss::class)
            ->findBy(['typeQAss' => $typeQAss], [$sort => $direction]);
    
        return $this->render('question_ass/index.html.twig', [
            'question_asses' => $questionAsses,
        ]);
    }
    

}