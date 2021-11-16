<?php

namespace App\Controller;

use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;

#[Route('/echoppe')]
class EchoppeController extends AbstractController
{
	#[Route('/', name:'echoppe_index', methods:['GET', 'POST'])]
	public function index(Request $request, ProduitRepository $produitRepository): Response
	{
		$form = $this->createForm(ProductType::class);
		$orderBy = ['name','ASC'];
		$categorie = [];

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$orderBy = explode(" ", $form->get('filtre')->getData());
			$catData = $form->get('categories')->getData();
			if ($catData != null) {
				$categorie['categorie'] = $catData;
			}
		}

		return $this->render('echoppe/index2.html.twig', [
				'products' => $produitRepository->findBy($categorie, [$orderBy[0] => $orderBy[1]]),
				'form' => $form->createView()
			]);
	}
}
