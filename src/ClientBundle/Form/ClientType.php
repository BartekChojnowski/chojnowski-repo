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
            ->add('name', 'text', array(
                'label' => 'nazwa',
                'attr' => array(
                    'maxlength' => 255
                )
            ))
            ->add('taxId', 'text', array(
                'label' => 'NIP',
                'required' => false,
                'attr' => array(
                    'maxlength' => 16
                )
            ))
            ->add('email', 'text', array(
                'label' => 'email',
                'required' => false,
                'attr' => array(
                    'maxlength' => 80
                )
            ))
            ->add('addresses', 'collection', array(
                'label' => 'adres',
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
