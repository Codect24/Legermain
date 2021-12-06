<?php

namespace App\Controller;

use App\Entity\CustomerRequest;
use App\Entity\JobOfferAnswer;
use App\Form\JobOfferAnswerType;
use App\Repository\CustomerRequestRepository;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Demande')]
class RequestController extends AbstractController
{
    #[Route('/', name: 'customerRequest')]
    public function index(): Response
    {

        $user = $this->getDoctrine()
            ->getRepository('App:User')
            ->findOneBy(array('email' => $this->getUser()->getUserIdentifier()));


        return $this->render('request/index.html.twig', [
            'controller_name' => 'RequestController',
            'requests' => $this->getDoctrine()->getRepository('App:CustomerRequest')->findBy(array('userId' => $user->getId())),
        ]);
    }

    #[Route('/new', name: 'customerRequest_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $customerRequest = new CustomerRequest();
        $form = $this->createForm(CustomerRequest::class, $customerRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customerRequest);
            $entityManager->flush();
            return $this->redirectToRoute('job_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer_request/new.html.twig', [
            'job_offer_answer' => $customerRequest,
            'form' => $form,
        ]);
    }
}
