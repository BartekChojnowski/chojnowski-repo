<?php

namespace CompanyBundle\Form;

use AddressBundle\Form\UserAddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployeeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', array('label' => 'imię'))
            ->add('lastName', 'text', array('label' => 'nazwisko'))
            ->add('personalId', 'text', array('label' => 'pesel'))
            ->add('dateOfBirth', 'datetime', array(
                'label' => 'data urodzenia',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy'
                )
            ))
            ->add('employmentStart', 'date', array(
                'label' => 'data rozpoczęcia pracy',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy'
                )
            ))
            ->add('employmentEnd', 'date', array(
                'label' => 'data zakończenia pracy',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy'
                )
            ))
            ->add('position','entity', array(
                'class' => 'CompanyBundle:Position',
                'choice_label' => 'name',
                'label' => 'stanowisko'

            ))
            ->add('status','entity', array(
                'class' => 'CompanyBundle:EmployeeStatus',
                'choice_label' => 'name',
                'label' => 'status'
            ))
//            ->add('addresses', 'collection', array(
//                'by_reference' => false,
//                'type'   => new UserAddressType(),
//                'allow_add'    => true,
//                'allow_delete' => true,
//            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CompanyBundle\Entity\Employee'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'companybundle_employee';
    }
}
