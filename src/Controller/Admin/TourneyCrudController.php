<?php

namespace App\Controller\Admin;

use App\Entity\Tourney;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TourneyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tourney::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            IntegerField::new('teamsSum'),
            TextField::new('date'),
            IntegerField::new('year')
        ];
    }

}
