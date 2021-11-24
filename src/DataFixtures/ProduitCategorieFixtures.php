<?php

namespace App\DataFixtures;

use App\Entity\ProduitCategorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitCategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		for ($i = 1; $i <= 3; $i++) {
			$produitcategorie = new ProduitCategorie();
			$produitcategorie
				->setName('Catégorie ' . $i);
			$manager->persist($produitcategorie);
			$this->addReference('category_'.$i, $produitcategorie);
		}
		$manager->flush();
    }
}
