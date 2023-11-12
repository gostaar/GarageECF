<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class VoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voiture::class; //comment ajouter les retaions?
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            NumberField::new('price'),
            TextEditorField::new('description'),
            TextEditorField::new('content'),
            TextField::new('modele'),
            BooleanField::new('est_vendu')
            ->formatValue(function ($value, $entity) {
                // Customize the formatting logic here
                return $value ? 'Oui' : 'Non'; // Display 'Oui' for true and 'Non' for false
            }),
            AssociationField::new('images'),
            AssociationField::new('categories'),
        ];
    }
    
}
