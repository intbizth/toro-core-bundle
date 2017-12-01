<?php

namespace Toro\Bundle\CoreBundle\Context;

use Sylius\Component\Customer\Context\CustomerContextInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Toro\Bundle\CoreBundle\Model\WebUserInterface;

final class CustomerContext implements CustomerContextInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * Gets customer based on currently logged user.
     *
     * @return CustomerInterface|null
     */
    public function getCustomer(): ?CustomerInterface
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return null;
        }

        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED') && $token->getUser() instanceof WebUserInterface) {
            return $token->getUser()->getCustomer();
        }

        return null;
    }

    public function __call($name, $arguments)
    {
        if (!$customer = $this->getCustomer()) {
            return;
        }

        return PropertyAccess::createPropertyAccessor()->getValue($customer, $name);
    }
}
