<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		$filesystem = new Filesystem();

		for ($i = 1; $i <= 10; $i++) {
			$product = new Produit();
			$product
				->setName('Product ' . $i)
				->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua')
				->setPrice(mt_rand(10, 600))
				->setCategorie($this->getReference('category_'.mt_rand(1, 3)));


			if ($filesystem->exists('D:\wamp64\www\Legermain\public\produits\\'.$i.'.png'))
			{
				$product->setVisualSrc($i.'.png');
			}
			$manager->persist($product);
		}
        $manager->flush();
    }
}
