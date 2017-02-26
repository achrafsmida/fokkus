<?php

namespace FKS\CentralBundle\Form;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class subNetworkType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $group = $options['group'];
        //dump($group); die;
        $builder->add('firstName')->add('lastName')->add('mail')->add('society'
        )->add('fix')->add('mobile')->add('twitter')->add('site')->add('description')
            ->add('network' , EntityType::class, array(
                'class' => 'FKSCentralBundle:Network',
                // 'choice_label' => 'article',
                'multiple' => false,
                'placeholder' => '--choisir une option--',
                //'expanded' => true,
                //'by_reference' => false,
                'query_builder' => function (EntityRepository $er) use ( $group )  {
                    return $er->createQueryBuilder('u')->where('u.group = :group')->setParameter('group', $group);
                },
            ))

        ->add('file')
        ->add('user',    UserType::class , array('label'=>"Paramétre d'authentification " , 'required' => false)) ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FKS\CentralBundle\Entity\subNetwork',
            'group' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fks_centralbundle_subnetwork';
    }


}
