<?php

namespace AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientAddressType extends AddressType
{
    /**
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
     * @return string
     */
    public function getName()
    {
        return 'clientbundle_clientAddress';
    }
}
