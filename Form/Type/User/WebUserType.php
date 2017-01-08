<?php

namespace Toro\Bundle\CoreBundle\Form\Type\User;

use Sylius\Bundle\UserBundle\Form\Type\UserType as BaseUserType;
use Symfony\Component\Form\FormBuilderInterface;

class WebUserType extends BaseUserType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('username')
            ->remove('email')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sylius_web_user';
    }
}
