<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreEv')
            ->add('categorieEv', ChoiceType::class, [
                'choices'  => [
                    'Art' => 'EvArt',
                    'Culture' => 'EVCulturel',
                    'Musique' => 'EvMusique',
                    'Sport' => 'EvSportif',
                    'religieux' => 'Evreligieux',
                ],
            ])
            ->add('descriptionEv')
            ->add('imageEv', FileType::class)
            ->add('adresseEv')
            ->add('region', ChoiceType::class, [
                'choices'  => [
                    'Tunis' => 'regionTunis',
                    'Bizerte' => 'regionBizerte',
                    'Nabeul' => 'regionNabeul',
                    'Tozeur' => 'regionTozeur',
                    'Mahdia' => 'regionMahdia',
                    'Sousse' => 'regionSousse',
                ],
            ])
            ->add('dateEv')
            ->add('nbrePlaces')
            //->add('idG')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
