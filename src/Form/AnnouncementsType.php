<?php

namespace App\Form;

use App\Entity\Announcements;
use App\Entity\CatAnnouncements;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AnnouncementsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('Brand', TextType::class, array('label' => 'Marque du matériel'))
                ->add('Model', TextType::class, array('label' => 'Modèle du matériel'))
                ->add('Description', EntityType::class, array(
                    'class' => CatAnnouncements::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e');
                        //->orderBy('e.username', 'ASC');
                    },
                    'choice_label' => 'label',
                    'label' => 'Catégorie : ',
                ))
                ->add('Price', TextType::class, array('label' => 'Prix du matériel'))
                ->add('Size', TextType::class, array('label' => 'Taille du matériel (h x l cm)'))
                ->add('Weight', TextType::class, array('label' => 'Poids du matériel (en kg)'))
                ->add('Quality', TextType::class, array('label' => 'Qualité du matériel'))
                ->add('Specifications', TextareaType::class, array('label' => 'Détail du matériel'))
                ->add('isOnSale')
                ->add('isSaled')
                ->add('ImageAnnouncements', FileType::class, array(
                    'data_class' => null,
                    'label' => 'Image'
                ))
                ->add('ImageAnnouncementsTwo', FileType::class, array(
                    'data_class' => null,
                    'label' => 'Image',
                    'required' => false
                ))
                ->add('ImageAnnouncementsThree', FileType::class, array(
                    'data_class' => null,
                    'label' => 'Image',
                    'required' => false
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Announcements::class,
        ]);
    }

}
