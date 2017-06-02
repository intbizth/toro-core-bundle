<?php

namespace Toro\Bundle\CoreBundle\OAuth;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class NotFoundAnEmailException extends AuthenticationException
{
    const ERROR_CODE = 'toro.ui.oauth_not_found_an_email';

    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return self::ERROR_CODE;
    }
}
