<?php

namespace App\Controller\Admin;

use App\Entity\TeachingAssignment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TeachingAssignmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TeachingAssignment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('programme')
            ->setEntityLabelInPlural('programmes');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('teacher', 'Professeur'),
            AssociationField::new('cours', 'Cours'),
            AssociationField::new('room', 'classe'),
        ];
    }

}
