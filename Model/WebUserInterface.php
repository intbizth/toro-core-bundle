<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Customer\Model\CustomerAwareInterface;
use Sylius\Component\User\Model\UserInterface as BaseUserInterface;

interface WebUserInterface extends BaseUserInterface, CustomerAwareInterface
{
}
