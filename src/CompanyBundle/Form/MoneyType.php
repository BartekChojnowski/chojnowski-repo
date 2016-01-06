<?php

namespace AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', 'text', array('label' => 'miasto'))
            ->add('currency','entity', array(
                'class' => 'CompanyBundle:EmployeeStatus',
                'choice_label' => 'name',
                'label' => 'status'

            ))
        ;
    }

    /**
     * @return string
     */
    abstract public function getName();
}
