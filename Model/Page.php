<?php

namespace Toro\Bundle\CoreBundle\Model;

use Toro\Bundle\CmsBundle\Model\BlameableTrait;
use Toro\Bundle\CmsBundle\Model\ChannelableTrait;
use Toro\Bundle\CmsBundle\Model\Page as BasePage;

class Page extends BasePage implements PageInterface
{
    use BlameableTrait;
    use ChannelableTrait;
}
