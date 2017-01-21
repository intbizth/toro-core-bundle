<?php

namespace Toro\Bundle\CoreBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Toro\Bundle\MediaBundle\Form\Type\ImageCollectionType;

class PostImageCollectionType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return ImageCollectionType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'toro_post_image_collection';
    }
}
