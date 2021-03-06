<?php

namespace App\Controller\Admin;

use App\Entity\CustomerRequest;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CustomerRequestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CustomerRequest::class;
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
