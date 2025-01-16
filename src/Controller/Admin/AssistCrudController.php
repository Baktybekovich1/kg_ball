<?php

namespace App\Controller\Admin;

use App\Entity\Assist;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AssistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Assist::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('player')->renderAsNativeWidget(),
            AssociationField::new('goal')->renderAsNativeWidget(),
            AssociationField::new('team')->renderAsNativeWidget(),
        ];
    }

}
