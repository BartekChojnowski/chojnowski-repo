<?php

namespace AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formularz adresu klienta
 *
 * @package AddressBundle\Form
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class ClientAddressType extends AddressType
{
    /**
     * Metoda ustawia domyślne opcje formularza
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AddressBundle\Entity\ClientAddress',
            'label' => false
        ));
    }

    /**
     * Metoda zwraca nazwę formularza
     *
     * @return string
     */
    public function getName()
    {
        return 'clientbundle_clientAddress';
    }
}
