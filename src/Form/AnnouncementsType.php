<?php

namespace App\Form;

use App\Entity\Announcements;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('fkUserId', EntityType::class, array(
            'class' => User::class,
            'query_builder' => function (EntityRepository $er) {
             return $er->createQueryBuilder('e')
             ->orderBy('e.username', 'ASC');
            },
            'choice_label' => 'username',
            'label'=> 'Login : ',
             ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Announcements::class,
        ]);
    }
}
