<?php

namespace App\Form;

use App\Entity\Banner;
use App\Entity\Announcements;
use App\Entity\CatAdd;
use App\Entity\Marketers;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BannerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Description')
            ->add('ImageBanner')
            ->add('Position')
            ->add('fkAnnouncementsId', EntityType::class, array(
            'class' => Announcements::class,
            'query_builder' => function (EntityRepository $er) {
             return $er->createQueryBuilder('e')
             ->orderBy('e.id', 'ASC');
            },
            'choice_label' => 'id',
            'label'=> 'Annonce n° : ',
             ))
            ->add('fkCatAddId', EntityType::class, array(
            'class' => CatAdd::class,
            'query_builder' => function (EntityRepository $er) {
             return $er->createQueryBuilder('e')
             ->orderBy('e.Label', 'ASC');
            },
            'choice_label' => 'Label',
            'label'=> 'Catégorie : ',
             ))
            ->add('fkMarketersId', EntityType::class, array(
            'class' => Marketers::class,
            'query_builder' => function (EntityRepository $er) {
             return $er->createQueryBuilder('e')
             ->orderBy('e.Label', 'ASC');
            },
            'choice_label' => 'Label',
            'label'=> 'Annonceur : ',
             ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Banner::class,
        ]);
    }
}
