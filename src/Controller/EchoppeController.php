<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;

#[Route('/echoppe')]
class EchoppeController extends AbstractController
{
	#[Route('/', name:'echoppe_index', methods:['GET'])]
	public function index(ProduitRepository $produitRepository): Response
	{
		return $this->render('echoppe/index.html.twig', ['produits' => $produitRepository->findAll(

		)]);
	}
}