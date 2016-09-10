<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug')
            ->add('name')
            ->add('description')
            ->add('aImg')
            ->add('bImg')
            ->add('cImg')
            ->add('catId')
            ->add('parentId')
            ->add('quantity')
            ->add('price')
            ->add('brandId')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Products'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_products';
    }
}
