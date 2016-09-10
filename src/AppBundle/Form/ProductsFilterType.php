<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;


class ProductsFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', Filters\NumberFilterType::class)
            ->add('slug', Filters\TextFilterType::class)
            ->add('name', Filters\TextFilterType::class)
            ->add('description', Filters\TextFilterType::class)
            ->add('aImg', Filters\TextFilterType::class)
            ->add('bImg', Filters\TextFilterType::class)
            ->add('cImg', Filters\TextFilterType::class)
            ->add('catId', Filters\NumberFilterType::class)
            ->add('parentId', Filters\NumberFilterType::class)
            ->add('quantity', Filters\NumberFilterType::class)
            ->add('price', Filters\NumberFilterType::class)
        ;


    }

    public function getBlockPrefix()
    {
        return 'appbundle_productsfiltertype';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
}
