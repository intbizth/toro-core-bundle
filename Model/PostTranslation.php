<?php

namespace Toro\Bundle\CoreBundle\Model;

use Toro\Bundle\CmsBundle\Model\PostTranslation as BasePostTranslation;
use Toro\Bundle\TaggingBundle\Model\TagableTrait;

class PostTranslation extends BasePostTranslation
{
    use TagableTrait {
        __construct as private initializeTagable;
    }

    public function __construct()
    {
        $this->initializeTagable();
    }
}
