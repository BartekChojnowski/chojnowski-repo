<?php

namespace CompanyBundle\Form;

use ClientBundle\Form\ClientType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FreightType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', 'text', array('label' => 'numer'))
            ->add('start', 'datetime', array(
                'label' => 'data od',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => false,
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy'
                )
            ))
            ->add('end', 'datetime', array(
                'label' => 'data do',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => false,
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy'
                )
            ))
            ->add('origin', 'text', array('label' => 'skąd'))
            ->add('destination', 'text', array('label' => 'dokąd'))
            ->add('distance', 'text', array('label' => 'odległość'))
            ->add('distanceToOrigin', 'text', array('label' => 'odległość do zlecenia'))
            ->add('price', 'money', array(
                'divisor' => 100,
                'label' => 'stawka',
                'currency' => 'PLN'
            ))
            ->add('driver','entity', array(
                'class' => 'CompanyBundle:Employee',
                'choice_label' => 'fullName',
                'label' => 'kierowca'

            ))
            ->add('car','entity', array(
                'class' => 'FleetBundle:Car',
                'choice_label' => 'registrationNumber',
                'label' => 'samochód'

            ))
            ->add('client', new ClientType(), array(
                'label' => 'klient'
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
            'data_class' => 'CompanyBundle\Entity\Freight'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'companybundle_freight';
    }
}