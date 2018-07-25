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
 
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, array('label' => 'Nom / Prénom'))
            ->add('avatar', FileType::class, array('data_class' => null))
            ->add('email', EmailType::class)            
            ->add('username', TextType::class, array('label' => 'Login'))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Répéter Mot de passe'),
            ))
            ->add('typeRoles', ChoiceType::class, array(
                "label" => "vous êtes : ",
                'multiple' => false,
                'expanded' => true,
                'choices' => array(
                    'Vous êtes : ' => null,
                    'Utilisateur' => '2',
                    'Annonceur' => '3',
                )
            ))
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
