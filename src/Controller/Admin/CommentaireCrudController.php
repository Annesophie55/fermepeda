<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom')->setDisabled(),
            IntegerField::new('note', 'Note')->setDisabled(),
            TextareaField::new('commentaire', 'Commentaire')->setDisabled(),
            BooleanField::new('statut', 'Validé'), // Ajoute un switch pour activer/désactiver un commentaire
            DateTimeField::new('date', 'Date')->setDisabled(),
        ];
    }
}
