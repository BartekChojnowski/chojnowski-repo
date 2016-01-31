<?php

namespace AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formularz adresu firmy
 *
 * @package AddressBundle\Form
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class CompanyAddressType extends AddressType
{
    /**
     * Metoda ustawia domyślne opcje formularza
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AddressBundle\Entity\CompanyAddress'
        ));
    }

    /**
     * Metoda zwraca nazwę formularza
     *
     * @return string
     */
    public function getName()
    {
        return 'addressbundle_companyAddress';
    }
}
