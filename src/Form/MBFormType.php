<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class MBFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => ['Homme' => 1,
                    'Femme' => 2]
            ])
            ->add('taille', NumberType::class, [
                'label' => 'Taille (cm)'
            ])
            ->add('poids', IntegerType::class, [
                'label' => 'Poids (kg)'
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Age'
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Age'
            ])
            ->add('coef', RangeType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 6,
                    'class' => "slider"
                ],
                'label' => "Niveau d'activité physique"
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])
        ;
    }
}
