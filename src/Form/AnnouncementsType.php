<?php

namespace App\Form;

use App\Entity\Announcements;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AnnouncementsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('Description')
                ->add('Price')
                ->add('Size')
                ->add('Weight')
                ->add('Quality')
                ->add('Specifications')
                ->add('ImageAnnouncements', FileType::class, array(
                    'data_class' => null
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Announcements::class,
        ]);
    }

}
