<?php

namespace App\Storage;

use App\Entity\Order;
use App\Repository\OrderRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class CartSessionStorage
{
	private $session;
	private $cartRepository;
	private $security;
	const CAR_KEY_NAME = 'cart_id';

	public function __construct(SessionInterface $session, OrderRepository $cartRepository, Security $security)
	{
		$this->session = $session;
		$this->cartRepository = $cartRepository;
		$this->security = $security;
	}

	public function getCart(): ?Order
	{
		$user = $this->security->getUser();
		return $this->cartRepository->findOneBy(['status' => Order::STATUT_CART, 'user' => $user]);
	}

	public function setCart(Order $cart): void
	{
		$this->session->set(self::CAR_KEY_NAME, $cart->getId());
	}

	private function getCartId(): ?int
	{
		return $this->session->get(self::CAR_KEY_NAME);
	}
}