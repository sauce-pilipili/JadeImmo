<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\AnnoncesSearch;
use App\Repository\AnnoncesRepository;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnoncesSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('coupDeCoeur', CheckboxType::class, [
                'label' => false,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('localisation',EntityType::class,[
                'class'=>Annonces::class,
                'label'=>false,
                'choice_label'=>'localisation',
//                'query_builder'=> function(AnnoncesRepository $annoncesRepository){
//                return $annoncesRepository->createQueryBuilder('a')
//                    ->select('a.localisation');
//                }


            ])
            ->add('typeDeBien', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Villa' => 'Villa',
                    'Maison' => 'Maison',
                    'Appartement' => 'Appartement',
                    'Terrain' => 'Terrain',
                    'Propriété/Chateau' => 'Propriété/Chateau',
                    'Immeuble' => 'Immeuble',
                ],
                'attr' => [

                    'class' => 'inputForm',
                ]
            ])
            ->add('surfaceHabitableMax', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface maximum',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('sufaceHabitableMin', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface minimum',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('surfaceDuTerrainMax', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface maximum',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('surfaceDuTerrainMin', NumberType::class, [
                'label' => false,
                'attr' => [

                    'class' => 'inputFormHono',
                ]
            ])
            ->add('nombreDeChambre', NumberType::class, [
                'label' => false,
                'attr' => [

                    'class' => 'inputFormHono',
                ]
            ])
            ->add('prixMax')
            ->add('prixMin')
            ->add('piscine', CheckboxType::class, [
                'label' => false,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('garage', CheckboxType::class, [
                'label' => false,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('balcon', CheckboxType::class, [
                'label' => false,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('parking', CheckboxType::class, [
                'label' => false,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('jardin', CheckboxType::class, [
                'label' => false,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('cave', CheckboxType::class, [
                'label' => false,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnnoncesSearch::class,
        ]);
    }
}
