<?php

namespace App\Command;

use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RemoveExpiredCartsCommand extends Command
{
	private $entityManager;

	private $orderRepository;

	protected static $defaultName = 'app:remove-expired-carts';

	public function __construct(EntityManagerInterface $entityManager, OrderRepository $orderRepository)
	{
		parent::__construct();
		$this->entityManager = $entityManager;
		$this->orderRepository = $orderRepository;
	}

	protected function configure(): void
    {
        $this
			->setDescription('Supprime les paniers inactifs depuis une période donnée')
			->addArgument(
				'days',
				InputArgument::OPTIONAL,
				'Jours d\'inactivité tolérés',
				1
			)
		;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $days = $input->getArgument('days');

        if ($days <= 0) {
            $io->error('Le nombre de jours doit être supérieur à 0.');
			return Command::FAILURE;
        }

        $limitDate = new \DateTime("- $days days");
		$expiredCartsCount = 0;

        while ($carts = $this->orderRepository->findCartsNotModifiedSince($limitDate)) {
			foreach ($carts as $cart){
				$this->entityManager->remove($cart);
			}

			$this->entityManager->flush();
			$this->entityManager->clear();

			$expiredCartsCount += count($carts);
		}

		if ($expiredCartsCount) {
			$io->success("Suppression de $expiredCartsCount panier(s)");
		}
		else {
			$io->info('Aucun panier à supprimer');
		}

		return Command::SUCCESS;
    }
}
