<?php

namespace App\Controller\Admin;

use App\Entity\Profile;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Profile::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('full_name'),
            TextField::new('genre'),
            DateTimeField::new('birth_date'),
            AssociationField::new('associate_user'),
        ];
    }
    
}
