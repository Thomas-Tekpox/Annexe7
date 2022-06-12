<?php

namespace App\Form;

use App\Entity\Galerie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lbl', TextType::class, [
                'label' => 'Nom de la galerie',
                'attr' => [
                            'placeholder' => 'Entrez le nom de la galerie',
                            'class' => 'form-control'
                            ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                            'placeholder' => 'Infos diverses',
                            'class' => 'form-control'
                            ]
            ])
            ->add('dimensionX', NumberType::class, [
                'label' => 'Largeur des photos',
                'attr' => [
                            'placeholder' => 'en px',
                            'class' => 'form-control'
                            ]
            ])
            ->add('dimensionY', NumberType::class, [
                'label' => 'Hauteur des photos',
                'attr' => [
                            'placeholder' => 'en px',
                            'class' => 'form-control'
                            ]
            ])
            ->add('actif', CheckboxType::class, [
                'label' => 'Actif ',
                'attr' => ['class' => 'form-control', 'checked'   => 'checked']
                ]);
}
            
public function configureOptions(OptionsResolver $resolver): void
    { 
        $resolver->setDefaults([
            'data_class' => Galerie::class,
        ]);
    }
}
