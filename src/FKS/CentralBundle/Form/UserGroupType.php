<?php

namespace FKS\CentralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Util\LegacyFormHelper;

class UserGroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('group', null, array('label' => 'groupe', 'attr' => array('class' => 'form-control')))
            ->add('username', null, array('label' => 'Login', 'attr' => array('class' => 'form-control')))
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'),
                array(
                    'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'Password', 'attr' => array('class' => 'form-control')),
                    'second_options' => array('label' => 'Confirmer Password', 'attr' => array('class' => 'form-control')),
                    'invalid_message' => 'fos_user.password.mismatch',
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FKS\CentralBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fks_centralbundle_user_group';
    }


}
