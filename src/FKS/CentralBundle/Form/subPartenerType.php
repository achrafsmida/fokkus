<?php

namespace FKS\CentralBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class subPartenerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $group = $options['group'];
        if ($options['group']) {
            $builder->add('firstName')->add('lastName')->add('mail')->add('society'
            )->add('fix')->add('mobile')->add('twitter')->add('site')->add('description')->add('partener', EntityType::class, array(
                'class' => 'FKSCentralBundle:Partener',
                // 'choice_label' => 'article',
                'multiple' => false,
                'placeholder' => '--choisir une option--',
                //'expanded' => true,
                //'by_reference' => false,
                'query_builder' => function (EntityRepository $er) use ($group) {
                    return $er->createQueryBuilder('u')->where('u.group = :group')->setParameter('group', $group);
                },
            ))->add('file');

        } else {
            $builder->add('firstName')->add('lastName')->add('mail')->add('society'
            )->add('fix')->add('mobile')->add('twitter')->add('site')->add('description')->add('partener', EntityType::class, array(
                'class' => 'FKSCentralBundle:Partener',
                // 'choice_label' => 'article',
                'multiple' => false,
                'placeholder' => '--choisir une option--',
                //'expanded' => true,
                //'by_reference' => false,
            ))->add('file');

        }

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FKS\CentralBundle\Entity\subPartener',
            'group' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fks_centralbundle_subpartener';
    }


}
