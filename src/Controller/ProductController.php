<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit')]
class ProductController extends AbstractController
{
    #[Route('/{id}', name: 'product_detail')]
    public function index(Produit $produit, Request $request, CartManager $cartManager): Response
    {
		$form = $this->createForm(AddToCartType::class);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid())
		{
			$item = $form->getData();
			$item->setProduct($produit);

			$cart = $cartManager->getCurrentCart();
			$cart
				->addItem($item)
				->setDateUpdate(new \DateTime());

			$cartManager->save($cart);

//			return $this->redirectToRoute('product_detail', ['id' => $produit->getId()]);
			return $this->redirectToRoute('echoppe_index');
		}


        return $this->render('product/detail2.html.twig', [
            'product' => $produit,
			'form' => $form->createView()
		]);
    }
}
