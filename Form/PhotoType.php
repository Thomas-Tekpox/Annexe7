<?php

namespace App\Form;

use App\Entity\GaleriePhotos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('imageFile', VichImageType::class, [
            'label' => 'Uploader votre photo',
        ])
                ->add('alt', TextType::class, [
            'label' => "Rentrer l'Alt de votre photo",
        ])
                ->add('visibilite', CheckboxType::class, [
            'label' => 'Photo visible ?',
            'data' => true,
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GaleriePhotos::class,
        ]);
    }
}