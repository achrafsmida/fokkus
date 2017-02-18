<?php

namespace FKS\CentralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NetworkType extends AbstractType
{
    /**
     * {@inheritdoc}
     */ 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $sub = $options['sub'];
        if ($sub) {
            $builder->add('type')
                ->add('haveUser')
                ->add('group');
        } else {
            $builder->add('type')->add('haveUser');
        }


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FKS\CentralBundle\Entity\Network',
            'sub' => null

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fks_centralbundle_network';
    }


}
