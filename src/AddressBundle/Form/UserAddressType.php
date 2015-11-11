<?php

namespace AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserAddressType extends AddressType
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AddressBundle\Entity\UserAddress'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'addressbundle_userAddress';
    }
}
