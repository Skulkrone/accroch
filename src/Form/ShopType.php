<?php

namespace App\Form;

use App\Entity\Shop;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ShopType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('Label')
                ->add('ShopImage', FileType::class)
                ->add('Logo', FileType::class)
                ->add('fkUserId', EntityType::class, array(
                    'class' => User::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e');
                        //->orderBy('e.username', 'ASC');
                    },
                    'choice_label' => 'username',
                    'label' => 'Login : ',
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Shop::class,
        ]);
    }

}
