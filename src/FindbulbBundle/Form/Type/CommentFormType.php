<?php

namespace FindbulbBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', 'textarea', array(
                'label' => false
            ))
            ->add('idea', 'hidden')
            ->add('parent', 'hidden')
            ->add('submit', 'submit', array(
                'label' => 'Add'
            ))
              
        ;
    }

    public function getName()
    {
        return 'comment';
    }
}