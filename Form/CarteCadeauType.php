<?php

namespace App\Form;

// use App\Entity\User;
use App\Entity\CarteCadeau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CarteCadeauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('codeCheque', TextType::class, [
            'label' => 'Rentrez le code chèque',
            'attr' => ['placeholder' => 'XXXX-XXXX-XXXX-XXXX']
        ])
                ->add('montant', MoneyType::class, [
            'label' => 'Montant de la carte cadeau',
            'attr' => ['placeholder' => '50']
        ])
                ->add('DLC', DateType::class, [
            'label' => 'Date limite de consomation',
            'attr' => ['class' => 'form-control']
        ])
                ->add('divers', TextareaType::class, [
            'label' => 'Montant de la carte cadeau',
            'attr' => ['placeholder' => 'Des choses à ajouter ?']
        ]);
        //         ->add('user', EntityType::class, [
        //     'label' => 'Chercher le client qui a acheter la carte cadeau',
        //     'attr' => ['placeholder' => 'selectionner un client'],
        //     'class' => User::class,
        //     'choice_label' => function(User $user) {
        //         return $user->getPrenom()." ".$user->getNom();
        //     }
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarteCadeau::class,
        ]);
    }
}
