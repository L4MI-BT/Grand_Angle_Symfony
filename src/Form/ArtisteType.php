<?php

namespace App\Form;

use App\Entity\Artiste;
use App\Entity\Employe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('anneeNaissance', null, [
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('image', null, [
                'required' => false,
                'label' => 'Nom du fichier image',
                'help' => 'Ex: images/monimage.jpg',
            ])
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => function(Employe $employe) {
                    return $employe->getPrenom().''.$employe->getNom();
                },
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artiste::class,
        ]);
    }
}
