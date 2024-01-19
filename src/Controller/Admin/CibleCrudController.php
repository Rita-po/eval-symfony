<?php

namespace App\Controller\Admin;

use App\Entity\Cible;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CibleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cible::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom', 'Nom:');
        yield TextField::new('prenom', 'Prénom:');
        yield DateField::new('naissance', 'Date de naissance:')->setFormat('dd/MM/yyyy');
        yield TextField::new('code', 'Code:');
        yield TextField::new('pays', 'Pays:');
    }
}