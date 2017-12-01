<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Resource\Model\TranslationInterface;
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
            new MediaReference('/post-'.$this->collectionOwner->getId(), 'imageId', $this->imageId, $this->image),
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): TranslationInterface
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
