<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/produit/{id}', name: 'product_detail')]
    public function index(Produit $produit): Response
    {
        return $this->render('product/detail.html.twig', [
            'product' => $produit]);
    }
}
