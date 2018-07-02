<?php

namespace App\Form;

use App\Entity\CatShop;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Label')
            ->add('Description')
            ->add('ImageCatShop')
            ->add('fkShopId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CatShop::class,
        ]);
    }
}
