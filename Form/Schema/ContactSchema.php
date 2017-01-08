<?php

namespace Toro\Bundle\CoreBundle\Form\Schema;

use Toro\Bundle\CustomFormBundle\Schema\SchemaInterface;
use Toro\Bundle\CustomFormBundle\Schema\FormsBuilderInterface;
use Symfony\Component\Form\FormBuilderInterface;

class ContactSchema implements SchemaInterface
{
    public function buildForms(FormsBuilderInterface $builder)
    {
        $builder
            ->setDefaults(array(
                'title'            => 'Sylius - Modern ecommerce for Symfony',
                'meta_keywords'    => 'symfony, sylius, ecommerce, webshop, shopping cart',
                'meta_description' => 'Sylius is modern ecommerce solution for PHP. Based on the Symfony framework.',
            ))
            ->setAllowedTypes(array(
                'title'            => array('string'),
                'meta_keywords'    => array('string'),
                'meta_description' => array('string'),
            ))
        ;
    }

    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('title')
            ->add('meta_keywords')
            ->add('meta_description', 'textarea')
            ->add('submit', 'submit')
        ;
    }
}
