<?php

namespace CompanyBundle\Form;

use AddressBundle\Form\CompanyAddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
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
                'type'   => new CompanyAddressType(),
                'allow_add'    => true,
                'allow_delete' => true,
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CompanyBundle\Entity\Company'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'companybundle_company';
    }
}
