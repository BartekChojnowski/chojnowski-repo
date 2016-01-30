<?php

namespace CompanyBundle\Form;

use AddressBundle\Form\EmployeeAddressType;
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
            ->add('firstName', 'text', array(
                'label' => 'imię',
                'attr' => array(
                    'maxlength' => 60
                )
            ))
            ->add('lastName', 'text', array(
                'label' => 'nazwisko',
                'attr' => array(
                    'maxlength' => 60
                )
            ))
            ->add('personalId', 'text', array(
                'label' => 'pesel',
                'required' => false,
                'attr' => array(
                    'maxlength' => 11
                )
            ))
            ->add('dateOfBirth', 'datetime', array(
                'label' => 'data urodzenia',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd',
                    'data-date-autoclose' => true,
                    'maxlength' => 9
                )
            ))
            ->add('employmentStart', 'date', array(
                'label' => 'data rozpoczęcia pracy',
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd',
                    'data-date-autoclose' => true,
                    'maxlength' => 9
                )
            ))
            ->add('employmentEnd', 'date', array(
                'label' => 'data zakończenia pracy',
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array(
                    'language' => 'pl',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-MM-dd',
                    'maxlength' => 9
                )
            ))
            ->add('groups', 'entity', array(
                'multiple' => true,
                'expanded' => true,
                'property' => 'name',
                'class'    => 'CompanyBundle\Entity\Group',
                'label' => 'grupa'
            ))
            ->add('status','entity', array(
                'class' => 'CompanyBundle:EmployeeStatus',
                'choice_label' => 'name',
                'label' => 'status'

            ))
            ->add('address', new EmployeeAddressType(), array(
                'label' => 'adres'
            ));
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
