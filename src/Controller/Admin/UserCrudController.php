<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud{
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lastname')->setLabel('Nom'),
            TextField::new('firstname', 'Prenom'),
            TextField::new('email', 'email')
            ->onlyWhenCreating(),
            Field::new('password')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Mot de passe',
                        'attr' => [
                            'class' => 'form-control col-md-4',
                            'placeholder' => 'Veuillez saisir votre mot de passe',
                            'id' => 'password'
                        ],],
                    'second_options' => ['label' => 'Confirmez mon de passe',
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => 'Veuillez confirmer votre mot de passe',
                            'id' => 'passwordConfirmed'
                        ],],
                    'invalid_message' => 'The password fields must match.',
                ])
                ->onlyWhenCreating(),
            ImageField::new('photo')->setLabel('profile')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setBasePath('/uploads')
                ->setUploadDir('\public\uploads')
                ->setRequired(false),
        ];
    }
}
