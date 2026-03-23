<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Exposition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ExpositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('theme')
            ->add('dateDebut', DateType::class, [
                'widget'  => 'single_text',
                'required' => false,
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('horaires')
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'label' => 'Nom du fichier image',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPG, PNG, WEBP)',
                        ])
                ]
            ])
            ->add('modulePublicActif', CheckboxType::class, [
                'label' => 'Activer le module public',
                'required' => false,
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
            'data_class' => Exposition::class,
        ]);
    }
}
