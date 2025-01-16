<?php

namespace App\Controller\Admin;

use App\Entity\Goal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GoalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Goal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('player', 'Игрок')->renderAsNativeWidget(),
            AssociationField::new('game', 'Матч')->renderAsNativeWidget(),
            AssociationField::new('team', 'За команду')->renderAsNativeWidget(),
            AssociationField::new('typeOfGoal', 'Вид гола')->renderAsNativeWidget(),
        ];
    }

}
