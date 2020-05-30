<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('object', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Objet',
                ] 
            ])
            ->add('message', TextAreaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Message',
                    'rows' => 6
                ] 
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'button-send'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
