<?php

namespace Toro\Bundle\CoreBundle\Model;

use Toro\Bundle\CmsBundle\Model\BlameableTrait;
use Toro\Bundle\CmsBundle\Model\ChannelableTrait;
use Toro\Bundle\CmsBundle\Model\Post as BasePost;
use Toro\Bundle\MediaBundle\Model\ImageCollectionAwareTrait;

class Post extends BasePost implements PostInterface
{
    use BlameableTrait;
    use ChannelableTrait;
    use ImageCollectionAwareTrait;

    public function __construct()
    {
        parent::__construct();

        $this->initializeImageCollection();
    }

    /**
     * {@inheritdoc}
     */
    public static function getImageCollectionTargetEntity()
    {
        return PostImageCollectionInterface::class;
    }
}
