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
            ->add('city', 'text', array(
                'label' => 'miasto',
                'attr' => array(
                    'maxlength' => 120
                )
            ))
            ->add('postcode', 'text', array(
                'label' => 'kod pocztowy',
                'required' => false,
                'attr' => array(
                    'maxlength' => 20
                )
            ))
            ->add('street', 'text', array(
                'label' => 'ulica', 'required' => false,
                'attr' => array(
                    'maxlength' => 120
                )
            ))
            ->add('number', 'text', array(
                'label' => 'numer', 'required' => false,
                'attr' => array(
                    'maxlength' => 15
                )
            ))
        ;
    }

    /**
     * @return string
     */
    abstract public function getName();
}
