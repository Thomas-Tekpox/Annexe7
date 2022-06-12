<?php

namespace App\Form;

use App\Entity\CodePromo;
use App\Form\ProduitCodePromoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CodePromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('montantMinimum', MoneyType::class, [
            'label' => 'Montant minimum en € requis pour appliquer la promotion',
            'attr' => ['placeholder' => '10']
        ])
                ->add('montant', TextType::class, [
            'label' => 'Montant en € ou %',
            'attr' => ['placeholder' => '10']
        ])
                ->add('DLC', DateType::class, [
            'label' => 'Date limite de consomation',
            'attr' => ['class' => 'form-control']
        ])
                ->add('fraisDePortOfferts', CheckboxType::class, [
            'label' => 'Frais de port offert',
            'required' => false,
            'attr' => ['class' => 'form-control']
        ])
                ->add('typePromo', ChoiceType::class, [
            'label' => 'Type de promotion',
            'choices' => [
                'Euro €' => 'e',
                'Pourcentage %' => 'p',
            ],
            'attr' => ['class' => 'form-control']
        ])
                ->add('produits', null, [
                    'mapped' => false,
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CodePromo::class,
            'allow_extra_fields' => true
        ]);
    }
}