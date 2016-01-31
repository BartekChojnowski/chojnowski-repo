<?php

namespace AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Nadrzędny formularz adresu
 *
 * @package AddressBundle\Form
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
abstract class AddressType extends AbstractType
{
    /**
     * Metoda zajmuje się utwarzeniem formularza
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            # miasto
            ->add('city', 'text', array(
                'label' => 'miasto',
                'attr' => array(
                    'maxlength' => 120
                )
            ))
            #kod pocztowy
            ->add('postcode', 'text', array(
                'label' => 'kod pocztowy',
                'required' => false,
                'attr' => array(
                    'maxlength' => 20
                )
            ))
            # ulica
            ->add('street', 'text', array(
                'label' => 'ulica', 'required' => false,
                'attr' => array(
                    'maxlength' => 120
                )
            ))
            #numer domu
            ->add('number', 'text', array(
                'label' => 'numer', 'required' => false,
                'attr' => array(
                    'maxlength' => 15
                )
            ));
    }

    /**
     * Metoda zwraca nazwę formularza
     *
     * @return string
     */
    abstract public function getName();
}
