<?php

namespace App\Controller\Admin;

use App\Entity\Repair;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RepairCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Repair::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('associate_service'),
            DateTimeField::new('confirmation_date'),
            DateTimeField::new('delivery_date'),
            TextField::new('problem'),
            TextEditorField::new('description'),
        ];
    }
    
}
