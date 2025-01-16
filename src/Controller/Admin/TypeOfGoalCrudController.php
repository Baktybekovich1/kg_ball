<?php

namespace App\Controller\Admin;

use App\Entity\TypeOfGoal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeOfGoalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeOfGoal::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
        ];
    }

}
