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
            ->add('city', 'text', array('label' => 'miasto'))
            ->add('postcode', 'text', array('label' => 'kod pocztowy'))
            ->add('street', 'text', array('label' => 'ulica'))
            ->add('number', 'text', array('label' => 'numer'))
        ;
    }

    /**
     * @return string
     */
    abstract public function getName();
}
