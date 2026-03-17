<?php

namespace App\Form;

use App\Entity\Emplacement;
use App\Entity\Espace;
use App\Entity\Exposition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmplacementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('positionX', NumberType::class, [
                'required' => false,
            ])
            ->add('positionY', NumberType::class, [
                'required' => false,
            ])
            ->add('description', null, [
                'required' => false,
            ])
            ->add('espace', EntityType::class, [
                'class' => Espace::class,
                'choice_label' => 'nomEspace',
            ])
            ->add('exposition', EntityType::class, [
                'class' => Exposition::class,
                'choice_label' => 'titre',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emplacement::class,
        ]);
    }
}
