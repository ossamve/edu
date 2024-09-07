<?php

namespace App\Controller\Admin;

use App\Entity\Student;
use App\Entity\Teacher;
use App\Enum\UserRole;
use App\Enum\UserStatus;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class StudentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Student::class;
    }

    public function configureCrud(Crud $crud): Crud{
        return $crud
            ->setEntityLabelInSingular(' un etudiant')
            ->setEntityLabelInPlural('Liste des etudiants')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        $required = true;
        if($pageName == 'edit'){
            $required = false;
        }
        return [
            TextField::new('lastname')->setLabel('Nom'),
            TextField::new('firstname', 'Prenom'),
            AssociationField::new('room', 'Classes'),
            TextField::new('email', 'Email')
                ->onlyWhenCreating(),
            TextField::new('password', 'Mot de passe')
                ->setFormType(PasswordType::class)
                ->onlyWhenCreating(),
            ImageField::new('photo')->setLabel('profile')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setBasePath('/uploads')
                ->setUploadDir('\public\uploads')
                ->setRequired($required),
            TextField::new('status', 'status')->onlyOnDetail(),

        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Student) {
            $entityInstance->setRoles([UserRole::STUDENT]);
            $entityInstance->setStatus(UserStatus::CREATED);
            if (is_null($entityInstance->getUsername())) {
                $entityInstance->setUsername(Uuid::uuid4()->toString());
            }

        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Student) {
            // You can also set or modify the roles on update if needed
        }

        parent::updateEntity($entityManager, $entityInstance);
    }

}
