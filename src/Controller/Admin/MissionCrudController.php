<?php

namespace App\Controller\Admin;

use App\Entity\Mission;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mission::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('titre', 'Titre:');
        yield ChoiceField::new('type', 'Type de mission:')
        ->setChoices([
            'Surveillance' => 'Surveillance',
        'Assassinat' => 'Assassinat',
        'Infiltration' => 'Infiltration',
        'Sabotage' => 'Sabotage',
        'Récupération de renseignements' => 'Récupération de renseignements',
        'Évasion' => 'Évasion',
        'Protection' => 'Protection',
        'Enquête' => 'Enquête',
        'Recrutement' => 'Recrutement',
        'Interrogatoire' => 'Interrogatoire',
        ]);
        yield ChoiceField::new('statut', 'Statut:')
        ->setChoices([
            'En préparation' => 'En préparation',
            'En cours' => 'En cours',
            'Terminé' => 'Terminé',
            'Échec' => 'Échec',
        ]);
        yield TextField::new('code', 'Code:');
        yield TextEditorField::new('description', 'Description:');
        yield DateField::new('date_debut', 'Date de début');
        yield DateField::new('date_fin', 'Date de fin');
        yield AssociationField::new('cibles', 'Cible(s):');
        yield TextField::new('pays', 'Pays:');
        yield ChoiceField::new('specialite_d', 'Spécialité exigée:')
            ->setChoices([
                'Espionnage industriel' => 'Espionnage industriel',
                'Cryptographie' => 'Cryptographie',
                'Infiltration' => 'Infiltration',
                'Contre-espionnage' => 'Contre-espionnage',
                'Écoute électronique' => 'Écoute électronique',
                'Désinformation' => 'Désinformation',
                'Interrogatoire' => 'Interrogatoire',
                'Opérations clandestines' => 'Opérations clandestines',
                'Surveillance discrète' => 'Surveillance discrète',
                'Analyse comportementale' => 'Analyse comportementale',
                'Techniques de camouflage' => 'Techniques de camouflage',
                'Piratage informatique' => 'Piratage informatique',
                'Contre-terrorisme' => 'Contre-terrorisme',
                'Extraction d\'informations' => 'Extraction d\'informations',
                'Gestion des identités fictives' => 'Gestion des identités fictives',
            ]);
            
        yield AssociationField::new('agents', 'Agent(s):');
        yield AssociationField::new('contacts', 'Contact(s):');
        yield AssociationField::new('planques', 'Planque:');
        
    }

    
}
