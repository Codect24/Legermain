<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\ProduitCategorie;
use App\Repository\ProduitCategorieRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
	private $produitCategorieRepository;

	public function __construct(ProduitCategorieRepository $produitCategorieRepository)
	{
		$this->produitCategorieRepository = $produitCategorieRepository;
	}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$cat = ['Toutes les catégories' => null];
		foreach ( $this->produitCategorieRepository->findAll() as $categorie )
		{
			$cat[$categorie->getName()] = $categorie;
		}
        $builder
			->add('filtre', ChoiceType::class, [
				'choices' => [
					'Nom' => [
						'a-z' => 'name ASC',
						'z-a' => 'name DESC'
					],
					'Prix' => [
						'du - au +' => 'price ASC',
						'du + au -' => 'price DESC'
					],
				],
				'multiple' => false,
				'expanded' => false,
				'mapped' => false,
			])
            ->add('categories', ChoiceType::class, [
				'choices' => $cat,
				'multiple' => false,
				'expanded' => true,
				'mapped' => false,
			])
		->add('submit', SubmitType::class, ['label' => 'Valider']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
