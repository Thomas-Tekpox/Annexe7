<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Brique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('nom', TextType::class, [
            'label' => 'Rentrez le nom de la page',
            'attr' => ['placeholder' => 'Collection enfant, Détails événement, ...']
        ])
                ->add('url', TextType::class, [
            'label' => "Saississez l'url de cette page (seulement la partie qui apparaitra après le dernier /)",
            'attr' => ['placeholder' => 'collection-enfant, details-evenement, ...']
        ])
                ->add('briques', EntityType::class, [
            'label' => 'Selectionner les briques que vous souhaitez utiliser',
            'attr' => ['class' => 'form-control'],
            'class' => Brique::class,
            'choice_label' => function(Brique $brique) {
                return $brique->getNom();
            }
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
