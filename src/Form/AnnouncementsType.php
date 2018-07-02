<?php

namespace App\Form;

use App\Entity\Announcements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Description')
            ->add('Price')
            ->add('Size')
            ->add('Weight')
            ->add('Quality')
            ->add('Specifications')
            ->add('ImageAnnouncements')
            ->add('fkUserId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Announcements::class,
        ]);
    }
}
