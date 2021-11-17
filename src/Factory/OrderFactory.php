<?php

namespace App\Factory;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Produit;

class OrderFactory
{
	public function create(): Order
	{
		$order = new Order();
		$order
			->setStatus(Order::STATUT_CART)
			->setDateCreation(new \DateTime())
			->setDateUpdate(new \DateTime());
		return $order;
	}

	public function createItem(Produit $produit): OrderItem
	{
		$item = new OrderItem();
		$item
			->setProduct($produit)
			->setQuantity(1);
		return $item;
	}
}