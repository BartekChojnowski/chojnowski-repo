<?php

namespace FleetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('make', 'text', array(
                'label' => 'marka',
                'attr' => array(
                    'maxlength' => 64
                )
            ))
            ->add('model', 'text', array(
                'label' => 'model',
                'attr' => array(
                    'maxlength' => 255
                )
            ))
            ->add('year', 'datetime', array(
                'label' => 'rok produkcji',
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy',
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy',
                    'data-date-start-view' => 'decade',
                    'data-date-min-view-mode' => 'years',
                    'data-date-autoclose' => true,
                    'maxlength' => 4
                )
            ))
            ->add('vin', 'text', array(
                'label' => 'VIN',
                'required' => false,
                'attr' => array(
                    'maxlength' => 20
                )
            ))
            ->add('engine', 'text', array(
                'label' => 'silnik',
                'required' => false,
                'attr' => array(
                    'maxlength' => 255
                )
            ))
            ->add('mileage', 'number', array(
                'label' => 'przebieg',
                'required' => false,
                'attr' => array(
                    'maxlength' => 11
                )
            ))
            ->add('registrationNumber', 'text', array(
                'label' => 'numer rej.',
                'attr' => array(
                    'maxlength' => 8
                )
            ))
            ->add('fuelType','entity', array(
                'required' => false,
                'class' => 'FleetBundle:FuelType',
                'choice_label' => 'name',
                'label' => 'paliwo'
            ))
            ->add('transmissionType','entity', array(
                'required' => false,
                'class' => 'FleetBundle:TransmissionType',
                'choice_label' => 'name',
                'label' => 'skrzynia biegów'
            ))
            ->add('description', 'textarea', array('label' => 'opis', 'required' => false,))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FleetBundle\Entity\Car'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fleetbundle_car';
    }
}
