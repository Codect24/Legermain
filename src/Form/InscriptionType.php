<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=>'Nom :',


            ])
            ->add('prenom', TextType::class, [
                'label'=>'Prenom :',


            ])
            ->add('password',RepeatedType::class,[
                'type'=> PasswordType::class,
                'invalid_message'=> 'la confirmation du mot de passe ne correspond pas',
                'label'=>'Mot de passe :',
                'required'=>true,
                'first_options'=>[ 'label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmation mot de passe :']
            ])
            ->add('email',RepeatedType::class,[
                'type'=> EmailType::class,
                'invalid_message'=> 'les emails ne correspondes pas',
                'required'=>true,
                'label'=> 'Adresse e-mail :',

                'first_options'=>[ 'label'=>'Adresse e-mail :'],
                'second_options' => ['label' => 'Confirmation addresse e-mail :']
            ])
            ->add('telephone',TextType::class,[
                'label' =>'Telephone :'
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success'],
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
