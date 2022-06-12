<?php

namespace App\Form;

use App\Form\TestPCType;
use App\Entity\TestPromo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('code', TextType::class, [
            'label' => 'code',
            'attr' => ['placeholder' => '1010-1010-1010-1010']
        ])
                ->add('testProduitPromos', CollectionType::class, [
            'entry_type' => TestPCType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'label' => 'XXX'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TestPromo::class,
            'allow_extra_fields' => true
        ]);
    }
}