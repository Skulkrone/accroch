<?php

namespace App\Form;

use App\Entity\Banner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Banner1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Description')
            ->add('ImageBanner')
            ->add('Position')
            ->add('fkAnnouncementsId')
            ->add('fkCatAddId')
            ->add('fkMarketersId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Banner::class,
        ]);
    }
}
