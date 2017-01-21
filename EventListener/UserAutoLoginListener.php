<?php

namespace Toro\Bundle\CoreBundle\EventListener;

use Sylius\Bundle\UserBundle\Security\UserLoginInterface;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Toro\Bundle\CoreBundle\Model\CustomerInterface;

final class UserAutoLoginListener
{
    /**
     * @var UserLoginInterface
     */
    private $userLogin;

    /**
     * @var string
     */
    private $firewall;

    /**
     * @param UserLoginInterface $userLogin
     */
    public function __construct(UserLoginInterface $userLogin, $firewall = 'web')
    {
        $this->userLogin = $userLogin;
        $this->firewall = $firewall;
    }

    /**
     * @param GenericEvent $event
     */
    public function login(GenericEvent $event)
    {
        $customer = $event->getSubject();

        if (!$customer instanceof CustomerInterface) {
            throw new UnexpectedTypeException(
                $customer,
                CustomerInterface::class
            );
        }

        if (null === $user = $customer->getUser()) {
            return;
        }

        try {
            $user->enable();
            $this->userLogin->login($user, $this->firewall);
        } catch (AccountStatusException $exception) {
            // We simply do not authenticate users which do not pass the user
            // checker (not enabled, expired, etc.).
        }
    }
}
