<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\CatShop;
use App\Entity\Shop;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('Label')
                ->add('Price')
                ->add('ImageProducts', FileType::class, array('label' => 'Image du Produit'))
                ->add('fkCatShopId', EntityType::class, array(
                    'class' => CatShop::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.Label', 'ASC');
                    },
                    'choice_label' => 'Label',
                    'label' => 'Nom du Produit : ',
                ))
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }

}
