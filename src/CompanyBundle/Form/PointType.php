<?php

namespace CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PointType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', null, array('label' => $options['label']))
            ->add('latitude', 'hidden', array('data' => ''))
            ->add('longitude', 'hidden', array('data' => ''))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CompanyBundle\Entity\Point'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'companybundle_point';
    }
}
