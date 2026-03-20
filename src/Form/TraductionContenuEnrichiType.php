<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Langue;
use App\Entity\TraductionContenuEnrichi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraductionContenuEnrichiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('traductionTexte', TextareaType::class, [
                'required' => false,
                'attr' => ['rows' => 8],
            ])
            ->add('urlAcces', null, [
                'required' => false,
                'label' => 'URL (audio/vidéo traduit)',
            ])
            ->add('ordreAffichage', null, [
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
            'data_class' => TraductionContenuEnrichi::class,
        ]);
    }
}