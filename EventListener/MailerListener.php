<?php

namespace Toro\Bundle\CoreBundle\EventListener;

use Sylius\Component\Mailer\Sender\SenderInterface;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\GenericEvent;
use Toro\Bundle\CoreBundle\Model\CustomerInterface;

class MailerListenerNO_NEED_FOR_NOW
{
    /**
     * @var SenderInterface
     */
    protected $emailSender;

    /**
     * @param SenderInterface $emailSender
     */
    public function __construct(SenderInterface $emailSender)
    {
        $this->emailSender = $emailSender;
    }

    /**
     * @param GenericEvent $event
     *
     * @throws UnexpectedTypeException
     */
    public function sendUserConfirmationEmail(GenericEvent $event)
    {
        $customer = $event->getSubject();

        if (!$customer instanceof CustomerInterface) {
            throw new UnexpectedTypeException(
                $customer,
                CustomerInterface::class
            );
        }

        if (null === ($user = $customer->getUser())) {
            return;
        }

        if (!$user->isEnabled()) {
            return;
        }

        if (null === ($email = $customer->getEmail()) || empty($email)) {
            return;
        }

        $this->emailSender->send('user_confirmation', [$email], ['user' => $user]);
    }
}
