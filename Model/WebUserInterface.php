<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Customer\Model\CustomerAwareInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Dos\Bundle\OAuthServerBundle\Model\UserInterface as DosOauthUserInterface;

interface WebUserInterface extends UserInterface, CustomerAwareInterface, EquatableInterface, DosOauthUserInterface
{
}
