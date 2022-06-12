<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\ProduitCodePromo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitCodePromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('produit', EntityType::class, [
                // looks for choices from this entity
                'class' => Produit::class,
                'choice_label' => 'lbl',
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProduitCodePromo::class,
        ]);
    }
}
