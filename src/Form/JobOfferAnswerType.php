<?php

namespace App\Form;

use App\Entity\JobOffer;
use App\Entity\JobOfferAnswer;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Validator\Constraints\File;

class JobOfferAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('firstName')
            ->add('mail', EmailType::class)
            ->add('phoneNumber')
            ->add('description', TextareaType::class, array('attr' => array('cols' => '5', 'rows' => '8')))
            ->add('cvFile', VichFileType::class, [
                'required' => true,
                'allow_delete' => true,
                'delete_label' => '...',
                'download_uri' => '...',
                'download_label' => '...',
                'asset_helper' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '30000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Le document c\'est pas un PDF',
                    ])
                ],
            ])
            ->add('lmFile', VichFileType::class, [
                'required' => true,
                'allow_delete' => true,
                'delete_label' => '...',
                'download_uri' => '...',
                'download_label' => '...',
                'asset_helper' => true,
            ])
            ->add('jobOfferId',HiddenType::class)
            ->add('archivingState',HiddenType::class)
            ->add('jobOfferState',HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobOfferAnswer::class,
        ]);
    }
}
