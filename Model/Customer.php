<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Customer\Model\Customer as BaseCustomer;
use Sylius\Component\User\Model\UserInterface as BaseUserInterface;

class Customer extends BaseCustomer implements CustomerInterface
{
    /**
     * @var WebUserInterface
     */
    protected $user;

    /**
     * {@inheritdoc}
     */
    public function hasUser()
    {
        return null !== $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): ?BaseUserInterface
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(?BaseUserInterface $user = null)
    {
        if ($this->user !== $user) {
            $this->user = $user;
            $this->assignCustomer($user);
        }
    }

    /**
     * @param WebUserInterface $user
     */
    protected function assignCustomer(WebUserInterface $user = null)
    {
        if (null !== $user) {
            $user->setCustomer($this);
        }
    }
}
