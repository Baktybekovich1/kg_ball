<?php

namespace App\Controller\Admin;

use App\Entity\AwardForTeam;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AwardForTeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AwardForTeam::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')
        ];
    }
}
