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
            ->add('make', 'text', array('label' => 'marka'))
            ->add('model', 'text', array('label' => 'model'))
            ->add('year', 'datetime', array(
                'label' => 'rok produkcji',
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy',
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy'
                )
            ))
            ->add('vin', 'text', array('label' => 'VIN', 'required' => false,))
            ->add('engine', 'text', array('label' => 'silnik', 'required' => false,))
            ->add('mileage', 'text', array('label' => 'przebieg', 'required' => false,))
            ->add('registrationNumber', 'text', array('label' => 'numer rej.'))
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
            ->add('description', 'text', array('label' => 'opis', 'required' => false,))
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
