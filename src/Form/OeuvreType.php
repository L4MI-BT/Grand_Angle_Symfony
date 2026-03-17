<?php

namespace App\Form;

use App\Entity\Artiste;
use App\Entity\Emplacement;
use App\Entity\Employe;
use App\Entity\Exposition;
use App\Entity\Oeuvre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OeuvreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('technique', null, [
                'required' => false,
            ])
            ->add('anneeCreation', null, [
                'required' => false,
            ])
            ->add('hauteurCm', NumberType::class, [
                'required' => false,
            ])
            ->add('largeurCm', NumberType::class, [
                'required' => false,
            ])
            ->add('profondeurCm', NumberType::class, [
                'required' => false,
            ])
            ->add('dateLivraisonPrevue', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('dateLivraisonReelle', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('artiste', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => function(Artiste $artiste) {
                    return $artiste->getPrenom().' '.$artiste->getNom();
                },
            ])
            ->add('exposition', EntityType::class, [
                'class' => Exposition::class,
                'choice_label' => 'titre',
                'required' => false,
            ])
            ->add('emplacement', EntityType::class, [
                'class' => Emplacement::class,
                'choice_label' => function(Emplacement $emplacement) {
                    return $emplacement->getEspace()->getNomEspace().' - '.($emplacement->getDescription() ?? 'Sans description');
                },
                'required' => false,
            ])
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => function(Employe $employe) {
                    return $employe->getPrenom().' '.$employe->getNom();
                },
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Oeuvre::class,
        ]);
    }
}