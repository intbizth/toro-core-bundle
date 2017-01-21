<?php

namespace Toro\Bundle\CoreBundle\Model;

use Toro\Bundle\MediaBundle\Meta\MediaReference;
use Toro\Bundle\MediaBundle\Model\ImageCollection;

class PostImageCollection extends ImageCollection implements PostImageCollectionInterface
{
    /**
     * {@inheritdoc}
     */
    public function getMediaMetaReferences()
    {
        return array(
            new MediaReference('/posts/'.$this->collectionOwner->getId(), 'imageId', $this->imageId, $this->image),
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation()
    {
        return new PostImageCollectionTranslation();
    }

    /**
     * {@inheritdoc}
     */
    public static function getCollectionOwnerTargetEntity()
    {
        return PostInterface::class;
    }
}
