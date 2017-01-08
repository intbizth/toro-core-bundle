<?php

namespace Toro\Bundle\CoreBundle\Form\EventSubscriber;

use Sylius\Component\Customer\Model\CustomerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UserRegistrationFormSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'submit',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function submit(FormEvent $event)
    {
        $customer = $event->getData();
        if (!$customer instanceof CustomerInterface) {
            throw new UnexpectedTypeException($customer, CustomerInterface::class);
        }

        if (null !== $user = $customer->getUser()) {
            $user->setEnabled(true);
        }
    }
}
