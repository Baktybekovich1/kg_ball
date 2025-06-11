<?php

namespace App\Controller\Admin;

use App\Entity\TestApi;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TestApiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TestApi::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('ls'),
            TextField::new('lastname'),
            TextField::new('address'),
            NumberField::new('bottle_q'),
            NumberField::new('tariff'),
            NumberField::new('sum'),
        ];
    }

}
