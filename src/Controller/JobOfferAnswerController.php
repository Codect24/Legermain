<?php

namespace App\Controller;

use App\Entity\JobOfferAnswer;
use App\Form\JobOfferAnswerType;
use App\Repository\JobOfferAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/job/offer/answer')]
class JobOfferAnswerController extends AbstractController
{
    #[Route('/', name: 'job_offer_answer_index', methods: ['GET'])]
    public function index(JobOfferAnswerRepository $jobOfferAnswerRepository): Response
    {
        return $this->render('job_offer_answer/index.html.twig', [
            'job_offer_answers' => $jobOfferAnswerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'job_offer_answer_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $jobOfferAnswer = new JobOfferAnswer();
        $form = $this->createForm(JobOfferAnswerType::class, $jobOfferAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobOfferAnswer);
            $entityManager->flush();

            return $this->redirectToRoute('job_offer_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('job_offer_answer/new.html.twig', [
            'job_offer_answer' => $jobOfferAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'job_offer_answer_show', methods: ['GET'])]
    public function show(JobOfferAnswer $jobOfferAnswer): Response
    {
        return $this->render('job_offer_answer/show.html.twig', [
            'job_offer_answer' => $jobOfferAnswer,
        ]);
    }

    #[Route('/{id}/edit', name: 'job_offer_answer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JobOfferAnswer $jobOfferAnswer): Response
    {
        $form = $this->createForm(JobOfferAnswerType::class, $jobOfferAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_offer_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('job_offer_answer/edit.html.twig', [
            'job_offer_answer' => $jobOfferAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'job_offer_answer_delete', methods: ['POST'])]
    public function delete(Request $request, JobOfferAnswer $jobOfferAnswer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobOfferAnswer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobOfferAnswer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_offer_answer_index', [], Response::HTTP_SEE_OTHER);
    }
}
