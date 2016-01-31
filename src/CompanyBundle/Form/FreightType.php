<?php

namespace CompanyBundle\Form;

use ClientBundle\Form\ClientType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formularz zlecenia
 *
 * @package AddressBundle\Form
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class FreightType extends AbstractType
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
            # numer zlecenia
            ->add('number', 'text', array('label' => 'numer'))
            # data rozpoczęcia zlecenia
            ->add('start', 'datetime', array(
                'label' => 'data',
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
            # data zakończenia zlecenia
            ->add('end', 'datetime', array(
                'label' => 'data do',
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
            # lokalizacja przed rozpoczęciem zlecenia
            ->add('startingPosition', new PointType(), array(
                'label' => 'dojazd z',
                'required' => false,
                'attr' => array(
                    'id' => 'origin',
                    'maxlength' => 255
                )
            ))
            # lokalizacja początkowa zlecenia
            ->add('origin', new PointType(), array(
                'label' => 'skąd',
                'attr' => array(
                    'id' => 'origin',
                    'maxlength' => 255
                )
            ))
            # lokazlizacja końcowa zlecenia
            ->add('destination', new PointType(), array(
                'label' => 'dokąd',
                'attr' => array(
                    'id' => 'destination',
                    'maxlength' => 255
                )
            ))
            # dystans zlecenia
            ->add('distance', 'number', array(
                'label' => 'odległość',
                'attr' => array(
                    'class' => 'input-group-lg reg_name',
                    'placeholder' => 'odległość',
                    'maxlength' => 11

                )
            ))
            # dystans do zlecenia
            ->add('distanceToOrigin', 'number', array(
                'label' => 'dojazd',
                'required' => false,
                'attr' => array(
                    'class' => 'input-group-lg reg_name',
                    'placeholder' => 'dojazd',
                    'maxlength' => 11
                )
            ))
            #stawka
            ->add('price', 'money', array(
                'divisor' => 100,
                'label' => 'stawka',
                'currency' => 'PLN',
                'attr' => array(
                    'maxlength' => 11
                )
            ))
            # kierowca
            ->add('driver','entity', array(
                'class' => 'CompanyBundle:Employee',
                'choice_label' => 'fullName',
                'label' => 'kierowca'

            ))
            # samochód
            ->add('car','entity', array(
                'class' => 'FleetBundle:Car',
                'choice_label' => 'registrationNumber',
                'label' => 'samochód'

            ))
            # klient
            ->add('client', new ClientType(), array(
                'label' => 'klient'
            ))
            # opis
            ->add('description', 'textarea', array('label' => 'opis', 'required' => false,))
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
            'data_class' => 'CompanyBundle\Entity\Freight'
        ));
    }

    /**
     * Metoda zwraca nazwę formularza
     *
     * @return string
     */
    public function getName()
    {
        return 'companybundle_freight';
    }
}
