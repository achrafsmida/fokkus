<?php

namespace Fokkus\V1Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class questionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('question',TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('typeofquestions', ChoiceType::class, array(
                'choices'  => array(
                    'Commercial' => 1,
                    'Communication' => 2,
                    'Technical' => 3,
                ) ,
                  'attr' => array('class' => 'form-control')  
                 ))   
                    ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fokkus\V1Bundle\Entity\question'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fokkus_v1bundle_question';
    }


}
