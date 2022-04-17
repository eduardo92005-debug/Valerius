<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cars::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $car = new Cars();
        $car->setUpdatedAt(new \DateTimeImmutable());

        return $car;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('name'),
            yield MoneyField::new('price')->setCurrency('EUR'),
            yield NumberField::new('year'),
            yield TextField::new('model'),
            yield ColorField::new('color'),
            yield TextField::new('tag'),
            yield ImageField::new('imageName')
                ->setUploadDir('public/images/products/')
                ->setUploadedFileNamePattern('car_' . random_int(1,1000) . '.jpg'),
            yield DateTimeField::new('updatedAt')->hideOnForm(),
            yield AssociationField::new('comments'),
        ];
    }
    
}
