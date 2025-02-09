<?php

namespace App\Controller\Admin;

use App\Entity\TourneyTeamPrizes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TourneyTeamPrizesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TourneyTeamPrizes::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('tourney')->renderAsNativeWidget(),
            AssociationField::new('firstPosition')->renderAsNativeWidget(),
            AssociationField::new('secondPosition')->renderAsNativeWidget(),
            AssociationField::new('thirdPosition')->renderAsNativeWidget()
        ];
    }

}
