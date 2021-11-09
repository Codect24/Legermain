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
	#[Route('/', name:'echoppe_index', methods:['GET'])]
	public function index(ProduitRepository $produitRepository): Response
	{
		$form = $this->createForm(ProductType::class);
		return $this->render('echoppe/index.html.twig', [
				'produits' => $produitRepository->findAll(),
				'form' => $form->createView()
			]);
	}

	#[Route('/', name: 'echoppe_filtered', methods: ['POST'])]
	public function form(Request $request, ProduitRepository $produitRepository): Response
	{
		$form = $this->createForm(ProductType::class);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid())
		{
			//Si pas de catégorie -> redirect index
			$categorie = $form->get('categories')->getData();
			return $this->render('echoppe/index.html.twig', [
				'produits' => $produitRepository->findBy(['categorie' => $form->get('categories')->getData()]),
				'form' => $form->createView()
			]);
		}
		else
		{
			return $this->redirectToRoute('echoppe_index');
		}
	}
}