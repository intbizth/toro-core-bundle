<?php

namespace Toro\Bundle\CoreBundle\Form\Extension;

use Sylius\Bundle\CustomerBundle\Form\Type\CustomerType;
use Toro\Bundle\CoreBundle\Form\EventSubscriber\AddUserFormSubscriber;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Toro\Bundle\CoreBundle\Form\Type\User\WebUserType;

final class CustomerTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new AddUserFormSubscriber(WebUserType::class));
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return CustomerType::class;
    }
}
