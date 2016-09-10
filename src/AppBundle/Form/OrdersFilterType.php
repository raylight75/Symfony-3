<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;


class OrdersFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', Filters\NumberFilterType::class)
            ->add('userId', Filters\NumberFilterType::class)
            ->add('orderDate', Filters\DateTimeFilterType::class)
            ->add('status', Filters\TextFilterType::class)
            ->add('productId', Filters\NumberFilterType::class)
            ->add('size', Filters\TextFilterType::class)
            ->add('img', Filters\TextFilterType::class)
            ->add('color', Filters\TextFilterType::class)
            ->add('quantity', Filters\NumberFilterType::class)
            ->add('amount', Filters\NumberFilterType::class)
        ;


    }

    public function getBlockPrefix()
    {
        return 'appbundle_ordersfiltertype';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
}
