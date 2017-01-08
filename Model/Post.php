<?php

namespace Toro\Bundle\CoreBundle\Model;

use Toro\Bundle\CmsBundle\Model\BlameableTrait;
use Toro\Bundle\CmsBundle\Model\ChannelableTrait;
use Toro\Bundle\CmsBundle\Model\Post as BasePost;

class Post extends BasePost implements PostInterface
{
    use BlameableTrait;
    use ChannelableTrait;
}
