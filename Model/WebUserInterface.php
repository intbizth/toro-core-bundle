<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Customer\Model\CustomerAwareInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

interface WebUserInterface extends UserInterface, CustomerAwareInterface, EquatableInterface
{
}
