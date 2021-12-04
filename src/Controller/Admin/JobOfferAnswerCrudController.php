<?php

namespace App\Controller\Admin;

use App\Entity\JobOfferAnswer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class JobOfferAnswerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOfferAnswer::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IdField::new('jobOfferId'),
            TextField::new('name'),
            TextField::new('firstName'),
            EmailField::new('mail'),
            TelephoneField::new('phoneNumber'),
            TextEditorField::new('description'),
            UrlField::new('linkCv'),
            UrlField::new('linkLm'),
            NumberField::new('jobOfferState'),
            BooleanField::new('archivingState'),
            DateTimeField::new('updatedAt'),
        ];
    }

}
