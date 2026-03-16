<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Fonction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('role')
            ->add('login')
            ->add('mdp')
            ->add('actif')
            ->add('supprime')
            ->add('dateCreation')
            ->add('dateSuppression')
            ->add('fonction', EntityType::class, [
                'class' => Fonction::class,
                'choice_label' => function(Fonction $function){
                    return $function->getIntitule();
                },
                'placeholder' => 'Choisir une fonction'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
