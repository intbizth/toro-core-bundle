<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Customer\Model\CustomerInterface as BaseCustomerInterface;
use Sylius\Component\User\Model\UserAwareInterface;

interface CustomerInterface extends BaseCustomerInterface, UserAwareInterface
{
    /**
     * @return bool
     */
    public function hasUser();
}
