<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Customer\Model\CustomerAwareInterface;

interface WebUserInterface extends UserInterface, CustomerAwareInterface
{
}
