<?php

namespace Toro\Bundle\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class RegisteredUser extends Constraint
{
    public $message = 'This email is already registered. Please log in.';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'registered_user_validator';
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
