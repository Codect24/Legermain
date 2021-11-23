<?php

namespace App\Form;

use App\Entity\ContactInfos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Regex;

class ContactInfosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('firstname')
            ->add('mail', EmailType::class,['label' => 'Email'])
            ->add('telephone',TelType::class, [
				'label' => 'Téléphone',
				'constraints' => new Regex('/(0|\+33|0033)+[1-9]+[0-9]{8}/', 'Saisissez un numéro de téléphone correct.')
				])
            ->add('title',TextType::class, ['label' => 'Titre du message'])
            ->add('message',TextType::class, ['label' => 'Message'])
			->add('save', SubmitType::class, ['label' => 'Envoyer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactInfos::class,
			'method' => 'GET'
        ]);
    }
}
