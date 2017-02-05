<?php

namespace Toro\Bundle\CoreBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Toro\Bundle\CmsBundle\Form\Type\YamlType;

class PostFlaggedTypeType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Name',
            ])
            ->add('singleActive', CheckboxType::class, [
                'required' => false,
                'label' => 'Single Active',
            ])
            ->add('config', YamlType::class, [
                'required' => true,
                'label' => 'Config',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber())
        ;
    }
}
