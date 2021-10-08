<?php

namespace App\Form;

use App\Entity\JobOfferAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('firstName')
            ->add('mail')
            ->add('phoneNumber')
            ->add('description')
            ->add('cv')
            ->add('motivationLetter')
            ->add('publicationDate')
            ->add('jobOfferState')
            ->add('archivingState')
            ->add('jobOfferId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobOfferAnswer::class,
        ]);
    }
}
