<?php

namespace Fokkus\V1Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
class formationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('description', TextareaType::class, array(
    'attr' => array('class' => 'form-control ckeditor' )))
                ->add('prix' ,IntegerType::class  , array('attr' => array('class' => 'form-control')))
                ->add('formationcateg', EntityType::class, array( 'attr' => array('class' => 'form-control') , 'class'    => 'FokkusV1Bundle:formationcateg'))      ;        ;        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fokkus\V1Bundle\Entity\formation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fokkus_v1bundle_formation';
    }


}
