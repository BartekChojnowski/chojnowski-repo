<?php

namespace ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AddressBundle\Form\ClientAddressType;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'nazwa'))
            ->add('taxId', 'text', array('label' => 'NIP', 'required' => false,))
            ->add('email', 'text', array('label' => 'email', 'required' => false,))
            ->add('addresses', 'collection', array(
                'by_reference' => false,
                'type'   => new ClientAddressType(),
                'allow_add'    => true,
                'allow_delete' => true,
            ))
            ->add('description', 'textarea', array('label' => 'dodatkowe informacje', 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClientBundle\Entity\Client'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clientbundle_client';
    }
}
