<?php

namespace App\Controller\Admin;

use App\Entity\JobOfferAnswer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JobOfferAnswerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOfferAnswer::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
