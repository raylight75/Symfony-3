<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userId')
            ->add('orderDate')
            ->add('status')
            ->add('productId')
            ->add('size')
            ->add('img')
            ->add('color')
            ->add('quantity')
            ->add('amount')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Orders'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_orders';
    }
}
