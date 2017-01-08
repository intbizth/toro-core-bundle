<?php

namespace Toro\Bundle\CoreBundle\EventListener;

use Sylius\Bundle\UserBundle\EventListener\PasswordUpdaterListener as BasePasswordUpdaterListener;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\GenericEvent;
use Toro\Bundle\CoreBundle\Model\CustomerInterface;

final class PasswordUpdaterListener extends BasePasswordUpdaterListener
{
    /**
     * @param GenericEvent $event
     */
    public function customerUpdateEvent(GenericEvent $event)
    {
        $customer = $event->getSubject();

        if (!$customer instanceof CustomerInterface) {
            throw new UnexpectedTypeException(
                $customer,
                CustomerInterface::class
            );
        }

        if (null !== $user = $customer->getUser()) {
            $this->updateUserPassword($user);
        }
    }
}
