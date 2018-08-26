<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('Name', TextType::class, array('label' => 'Nom'))
                ->add('firstName', TextType::class, array('label' => 'Prénom')) 
                ->add('address', TextType::class, array('label' => 'Adresse'))
                ->add('postalCode', TextType::class, array('label' => 'Code Postal'))
                ->add('city', TextType::class, array('label' => 'Ville'))
                ->add('email', EmailType::class)
                ->add('phone', TextType::class, array('label' => 'Téléphone'))
                ->add('username', TextType::class, array('label' => 'Login'))
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Mot de passe'),
                    'second_options' => array('label' => 'Répéter Mot de passe'),
                ))
                ->add('typeRoles', ChoiceType::class, array(
                    'required' => false,
                    "label" => "vous êtes : ",
                    'multiple' => false,
                    'expanded' => true,
                    'choices' => array(
                        'Utilisateur' => '2',
                        'Annonceur' => '3',
                    )
                ))
                ->add('avatar', FileType::class, array(
                    'data_class' => null,
                    'label' => 'Avatar',
                    'required' => false
                ))
                ->add('termsAccepted', CheckboxType::class, array(
                    'mapped' => false,
                    'constraints' => new IsTrue(),
                    "label" => "En créant votre compte, vous acceptez l'intégralité de nos 
Conditions générales de vente et d'utilisation.",
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

}
