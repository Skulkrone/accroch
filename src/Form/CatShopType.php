<?php

namespace App\Form;

use App\Entity\CatShop;
use App\Entity\Shop;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CatShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Label')
            ->add('Description')
            ->add('ImageCatShop')
            ->add('fkShopId', EntityType::class, array(
            'class' => Shop::class,
            'query_builder' => function (EntityRepository $er) {
             return $er->createQueryBuilder('e')
             ->orderBy('e.Label', 'ASC');
            },
            'choice_label' => 'Label',
            'label'=> 'Nom de la boutique : ',
             ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CatShop::class,
        ]);
    }
}
