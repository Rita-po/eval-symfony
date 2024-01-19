<?php

namespace App\Controller\Admin;

use App\Entity\Planque;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlanqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Planque::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield IntegerField::new('code', 'Code');
        yield TextField::new('adresse', 'Adresse');
        yield TextField::new('pays', 'Pays');
        yield TextField::new('type', 'Type');
    }
}

