<?php

namespace App\Controller;

use App\Entity\CustomerRequest;
use App\Form\CustomerRequestType;
use App\Repository\CustomerRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/customer/request')]
class CustomerRequestController extends AbstractController
{
    #[Route('/', name: 'customer_request_index', methods: ['GET'])]
    public function index(CustomerRequestRepository $customerRequestRepository): Response
    {
        return $this->render('customer_request/index.html.twig', [
            'customer_requests' => $customerRequestRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'customer_request_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $customerRequest = new CustomerRequest();
        $form = $this->createForm(CustomerRequestType::class, $customerRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customerRequest);
            $entityManager->flush();

            return $this->redirectToRoute('customer_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer_request/new.html.twig', [
            'customer_request' => $customerRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'customer_request_show', methods: ['GET'])]
    public function show(CustomerRequest $customerRequest): Response
    {
        return $this->render('customer_request/show.html.twig', [
            'customer_request' => $customerRequest,
        ]);
    }

    #[Route('/{id}/edit', name: 'customer_request_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CustomerRequest $customerRequest): Response
    {
        $form = $this->createForm(CustomerRequestType::class, $customerRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer_request/edit.html.twig', [
            'customer_request' => $customerRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'customer_request_delete', methods: ['POST'])]
    public function delete(Request $request, CustomerRequest $customerRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customerRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customerRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('customer_request_index', [], Response::HTTP_SEE_OTHER);
    }
}
