<?php

namespace App\Controller;

use App\Entity\ContactInfos;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactInfosType;

#[Route('/contact')]
class ContactController extends AbstractController
{
	#[Route('/',name: 'contact_index', methods: ['POST','GET'])]
	public function index(Request $request, MailerInterface $mailer): Response
	{
		$ContactInfos = new ContactInfos();
		$form = $this->createForm(ContactInfosType::class);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$ContactInfos = $form->getData();
			$message = (new Email())
				->from($ContactInfos->getMail())
				->to('contact@legermain.tom-lefrere.fr')
				->subject($ContactInfos->getTitle())
				->text($ContactInfos->getMessage());

			$mailer->send($message);
			return $this->redirectToRoute('contact_index');

		}
	return $this->render('contact/index.html.twig', [
		'form' => $form->createView(),
		]);
	}

}