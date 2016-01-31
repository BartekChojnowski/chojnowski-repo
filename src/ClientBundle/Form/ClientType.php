<?php

namespace ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AddressBundle\Form\ClientAddressType;

/**
 * Formularz klienta
 *
 * @package AddressBundle\Form
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class ClientType extends AbstractType
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
            # nazwa
            ->add('name', 'text', array(
                'label' => 'nazwa',
                'attr' => array(
                    'maxlength' => 255
                )
            ))
            # NIP
            ->add('taxId', 'text', array(
                'label' => 'NIP',
                'required' => false,
                'attr' => array(
                    'maxlength' => 16
                )
            ))
            # email
            ->add('email', 'text', array(
                'label' => 'email',
                'required' => false,
                'attr' => array(
                    'maxlength' => 80
                )
            ))
            # adresy
            ->add('addresses', 'collection', array(
                'label' => 'adres',
                'by_reference' => false,
                'type'   => new ClientAddressType(),
                'allow_add'    => true,
                'allow_delete' => true,
            ))
            # opis
            ->add('description', 'textarea', array('label' => 'dodatkowe informacje', 'required' => false))
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
            'data_class' => 'ClientBundle\Entity\Client'
        ));
    }

    /**
     * Metoda zwraca nazwę formularza
     *
     * @return string
     */
    public function getName()
    {
        return 'clientbundle_client';
    }
}
