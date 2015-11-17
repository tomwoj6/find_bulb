<?php

// src/AppBundle/Form/Type/TaskType.php
namespace FindbulbBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class IdeaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('category', 'entity', array(
                'class' => 'FindbulbBundle:Category',
                'choice_label' => 'name',
            ))
            ->add('type', 'entity', array(
                'class' => 'FindbulbBundle:Type',
                'choice_label' => 'name',
            ))
            ->add('description', 'textarea')
            ->add('file', 'file', array(
                'required' => false,
                'mapped' => false
            ))
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'idea';
    }
}