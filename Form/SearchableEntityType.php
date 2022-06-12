<?php

namespace App\Form;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchableEntityType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setRequired('class');
        $resolver->setDefaults([
            'compound' => false,
            'multiple' => true,
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options) {
        $view->vars['expanded'] = false;
        $view->vars['placeholder'] = null;
        $view->vars['placeholder_in_choices'] = false;
        $view->vars['multiple'] = true;
        $view->vars['preferred_choices'] = [];
        $view->vars['choices'] = [];
        $view->vars['choice_translation_domain'] = false;
        $view->vars['full_name'] += [];
    }

    public function getBlockPrefix() {
        return 'choice';
    }
}