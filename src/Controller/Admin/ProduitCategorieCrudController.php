<?php

namespace App\Controller\Admin;

use App\Entity\ProduitCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitCategorieCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return ProduitCategorie::class;
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideOnForm(),
			TextField::new('name')
		];
	}
}