<?php

namespace Toro\Bundle\CoreBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\UserBundle\UserEvents;
use Sylius\Component\User\Security\Generator\GeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Toro\Bundle\CoreBundle\Model\CustomerInterface;
use Toro\Bundle\CoreBundle\Model\WebUserInterface;
use Webmozart\Assert\Assert;

final class UserRegistrationListener
{
    /**
     * @var ObjectManager
     */
    private $userManager;

    /**
     * @var GeneratorInterface
     */
    private $tokenGenerator;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param ObjectManager $userManager
     * @param GeneratorInterface $tokenGenerator
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ObjectManager $userManager,
        GeneratorInterface $tokenGenerator,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->userManager = $userManager;
        $this->tokenGenerator = $tokenGenerator;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param GenericEvent $event
     */
    public function sendVerificationEmail(GenericEvent $event)
    {
        $customer = $event->getSubject();
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();
        Assert::notNull($user);

        $this->handleUserVerificationToken($user);
    }

    /**
     * @param WebUserInterface $user
     */
    private function handleUserVerificationToken(WebUserInterface $user)
    {
        $token = $this->tokenGenerator->generate();
        $user->setEmailVerificationToken($token);

        $this->userManager->persist($user);
        $this->userManager->flush();

        $this->eventDispatcher->dispatch(UserEvents::REQUEST_VERIFICATION_TOKEN, new GenericEvent($user));
    }
}
