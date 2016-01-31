<?php

namespace CompanyBundle\Form;

use AddressBundle\Form\EmployeeAddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formularz pracownika
 *
 * @package AddressBundle\Form
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class EmployeeType extends AbstractType
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
            # imię
            ->add('firstName', 'text', array(
                'label' => 'imię',
                'attr' => array(
                    'maxlength' => 60
                )
            ))
            # nazwisko
            ->add('lastName', 'text', array(
                'label' => 'nazwisko',
                'attr' => array(
                    'maxlength' => 60
                )
            ))
            # pesel
            ->add('personalId', 'text', array(
                'label' => 'pesel',
                'required' => false,
                'attr' => array(
                    'maxlength' => 11
                )
            ))
            # data urodzenia
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
            # data rozpoczęcia pracy
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
            # data zakończenia pracy
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
            # grupy, go których należy pracownik
            ->add('groups', 'entity', array(
                'multiple' => true,
                'expanded' => true,
                'property' => 'name',
                'class'    => 'CompanyBundle\Entity\Group',
                'label' => 'grupa'
            ))
            # status
            ->add('status','entity', array(
                'class' => 'CompanyBundle:EmployeeStatus',
                'choice_label' => 'name',
                'label' => 'status'

            ))
            # adres
            ->add('address', new EmployeeAddressType(), array(
                'label' => 'adres'
            ));
        ;
    }

    /**
     * Metoda ustawia domyślne opcje formularza
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CompanyBundle\Entity\Employee'
        ));
    }

    /**
     * Metoda zwraca nazwę formularza
     *
     * @return string
     */
    public function getName()
    {
        return 'companybundle_employee';
    }
}
