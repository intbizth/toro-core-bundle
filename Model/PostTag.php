<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Toro\Bundle\TaggingBundle\Model\Tag;

class PostTag extends Tag
{
    /**
     * @var ArrayCollection
     */
    private $tagables;

    public function __construct()
    {
        $this->tagables = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getTaggedCount()
    {
        // need to fetch: EXTRA_LAZY
        return $this->tagables->count();
    }
}
