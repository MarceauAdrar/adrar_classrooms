<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // TODO: Personnaliser le formulaire au besoin
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du véhicule',
                'attr' => [
                    'placeholder' => 'Nom du véhicule',
                ],
            ])
            ->add('couleur', ColorType::class, [
                'label' => 'Couleur du véhicule',
            ])
            ->add('marque')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
