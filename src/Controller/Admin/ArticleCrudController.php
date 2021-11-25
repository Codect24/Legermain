<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Article::class;
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->onlyOnIndex(),
			TextField::new('title'),
			TextEditorField::new('content'),
			DateField::new('publicationDate'),
			TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenCreating(),
			ImageField::new('image')->setBasePath('uploads/images/realisation')->onlyOnIndex(),
			BooleanField::new('highlighted'),
			SlugField::new('slug')->setTargetFieldName('title')
		];
	}
}
