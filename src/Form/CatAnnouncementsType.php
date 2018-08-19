<?php

namespace App\Form;

use App\Entity\CatAnnouncements;
use App\Entity\Announcements;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CatAnnouncementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Label')
            /*->add('fkAnnouncementsId', EntityType::class, array(
                    'class' => Announcements::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e');
                        //->orderBy('e.username', 'ASC');
                    },
                    'choice_label' => 'description',
                    'label' => 'Catégorie : ',
                ))*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CatAnnouncements::class,
        ]);
    }
}
