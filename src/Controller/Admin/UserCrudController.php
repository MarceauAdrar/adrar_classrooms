<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User) {
            // Hachage du mot de passe seulement s'il est défini (par exemple lors de la création)
            if ($entityInstance->getPassword()) {
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $entityInstance,
                    $entityInstance->getPassword()
                );
                $entityInstance->setPassword($hashedPassword);
            }
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User) {
            // Hachage du mot de passe seulement s'il est modifié
            if ($entityInstance->getPassword()) {
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $entityInstance,
                    $entityInstance->getPassword()
                );
                $entityInstance->setPassword($hashedPassword);
            }
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('username'),
            TextField::new('lastName'),
            TextField::new('firstName'),
            ImageField::new('image')
                ->setBasePath('public/assets/uploads/avatars') // Le chemin relatif pour afficher les images
                ->setUploadDir('assets/uploads/avatars') // Le chemin relatif pour stocker les images
                ->setUploadedFileNamePattern('[randomhash].[extension]') // Le nom des fichiers téléchargés
                ->setRequired(false)
                ->setTemplatePath('admin/fields/image.html.twig')
                ->onlyOnIndex(), 
            TextField::new('password')
                ->setFormType(PasswordType::class) // Utiliser le PasswordType pour masquer le mot de passe en clair
                ->onlyOnForms(), // Ce champ sera uniquement visible dans les formulaires de création/édition,
            TextField::new('googleId'),
        ];

        if (in_array($pageName, [Crud::PAGE_NEW, Crud::PAGE_EDIT])) {
            $fields[] = ImageField::new('image')
                ->setBasePath('public/assets/uploads/avatars')
                ->setUploadDir('assets/uploads/avatars')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->setLabel('Upload Image');
        }

        return $fields;
    }
}
