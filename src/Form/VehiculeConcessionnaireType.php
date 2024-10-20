<?php

namespace App\Form;

use App\Entity\Concessionnaire;
use App\Entity\Vehicule;
use App\Entity\VehiculeConcessionnaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeConcessionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('concessionnaire', EntityType::class, [
                'class' => Concessionnaire::class,
                'choice_label' => 'nom',
            ])
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VehiculeConcessionnaire::class,
        ]);
    }
}
