<?php

namespace Toro\Bundle\CoreBundle\Context;

use Sylius\Component\User\Model\UserInterface;

interface UserContextInterface
{
    /**
     * @return UserInterface|null
     */
    public function getUser();

    /**
     * check user's verification.
     *
     * @return bool
     */
    public function isVerified();
}
