<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'inputForm']
            ])
            ->add('metaDescription', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'inputForm']
            ])
            ->add('descriptionDuBien', TextAreaType::class, [
                'label' => false,

                'attr' => ['class' => 'inputFormArea',
                    'row' => 5]
            ])
            ->add('coupDeCoeur', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('prixAvecHonoraires', NumberType::class, [
                'label' => false,

                'attr' => [
                    'placeholder' => 'Écrivez le prix en euros',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('prixSansHonoraires', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez le prix en euros',
                    'class' => 'inputFormHono',
                ]
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
            ->add('localisation', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'inputForm']
            ])
            ->add('ImageEnAvant',FileType::class,[
                'label' => false,
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ])
            ->add('imageDuo',FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ->add('surfaceHabitable', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez la surface en m²',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('surfaceDuTerrain', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez la surface en m²',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('surfaceDeLaTerrasse', NumberType::class, [
                'required'=>false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez la surface en m²',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('nombreDeChambre', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez le nombre',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('nombreDeSalleDeBain', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez le nombre²',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('nombreDeToilettes', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez le nombre²',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('nombreEtages', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez le nombre',
                    'class' => 'inputFormHono',
                ]
            ])
            ->add('cheminee', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('piscine', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('garage', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('balcon', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('parking', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('jardin', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('cave', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
            ->add('gardien', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])

            ->add('terrasse', ChoiceType::class, [
                'choices' => [
                    'oui' => 1,
                    'non' => 0,
                ],
                'choice_attr' =>
                    ['class' => 'container'],
                'label' => false,
                'expanded' => true,
                'attr' => ['class' => 'inputCheck',
                ]
            ])
        ->add('systemDeSecurite', TextType::class, [
            'required'=> false,
            'label' => false,
            'attr' => [
                'class' => 'inputForm',
                'placeholder' => 'Décrivez le système de sécurité, si il y en as un',]
        ])
        ->add('photosGalerie',FileType::class,[
        'label' => false,
        'multiple' => true,
        'mapped' => false,
        'required' => false
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
