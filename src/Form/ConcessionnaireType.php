<?php

namespace App\Form;

use App\Entity\Concessionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcessionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('groupe')
            ->add('adresse_numero')
            ->add('adresse_rue')
            ->add('adresse_ville')
            ->add('adresse_cp')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Concessionnaire::class,
        ]);
    }
}
