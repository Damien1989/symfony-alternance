<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Quel nom souhaitez-vous donner à votre adresse ?',
                'attr' => [
                    'placeholder' => 'Nommez votre addresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Votre société',
                'attr' => [
                    'placeholder' => 'Entrez le nom de votre société (falcutatif)'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Quel nom souhaitez-vous donner à votre adresse ?',
                'attr' => [
                    'placeholder' => '6 rue des Rosiers...'
                ]
            ])
            ->add('postal', TextType::class, [
                'label' => 'Quel est votre code postal ?',
                'attr' => [
                    'placeholder' => 'Mentionnez votre code postal'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Quelle est votre ville',
                'attr' => [
                    'placeholder' => 'Indiquez votre ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'attr' => [
                    'placeholder' => 'Votre pays'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Quel est votre numéro de téléphone ?',
                'attr' => [
                    'placeholder' => 'Entrez votre numéro'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
