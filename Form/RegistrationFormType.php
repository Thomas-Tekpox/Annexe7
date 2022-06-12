<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'nom',
                'attr' => [
                    'placeholder' => 'votre nom',
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'prenom',
                'attr' => [
                    'placeholder' => 'votre prenom',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
                'attr' => [
                    'placeholder' => 'votre email',
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'Femme' => 'F',
                    'Homme' => 'H',
                    'Autre' => 'I',
                ],
            ])
            ->add('mobile', NumberType::class, [
                'label' => 'numéro de téléphone portable',
                'attr' => [
                    'placeholder' => 'votre numéro',
                ]
            ])
            ->add('date_naissance', BirthdayType::class, [
                'label' => 'Date de naissance',
                'attr' => [
                    'placeholder' => 'Select a value',
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le champ mot de passe doit correspondre.',
                'options' => ['attr' => ['class' => 'password-field']],
                'mapped' => false,
                'required' => true,
                'first_options'  => ['label' => 'Password',
                                     'attr' => ['autocomplete' => 'new-password'],
                                     'constraints' => [
                                        new NotBlank([
                                            'message' => 'Merci de saisir un mot de passe',
                                        ]),
                                        new Length([
                                            'min' => 6,
                                            'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
                                            // max length allowed by Symfony for security reasons
                                            'max' => 4096,
                                        ]),
                                        ]
                                    ],
                'second_options' => ['label' => 'Valider le mot de passe'],
            ])
            // ->add('plainPassword', PasswordType::class, [
            //     // instead of being set onto the object directly,
            //     // this is read and encoded in the controller
            //     'mapped' => false,
            //     'attr' => ['autocomplete' => 'new-password'],
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Please enter a password',
            //         ]),
            //         new Length([
            //             'min' => 6,
            //             'minMessage' => 'Your password should be at least {{ limit }} characters',
            //             // max length allowed by Symfony for security reasons
            //             'max' => 4096,
            //         ]),
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
