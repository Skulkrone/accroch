<?php

namespace App\Form;

use App\Entity\Shop;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Label')
            ->add('fkUserId', EntityType::class, array(
            'class' => User::class,
            'query_builder' => function (EntityRepository $er) {
             return $er->createQueryBuilder('e')
             ->orderBy('e.Username', 'ASC');
            },
            'choice_label' => 'Username',
            'label'=> 'Login : ',
             ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shop::class,
        ]);
    }
}
