<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Toro\Bundle\CmsBundle\Model\PostTranslation as BasePostTranslation;
use Toro\Bundle\TaggingBundle\Model\TagInterface;

class PostTranslation extends BasePostTranslation
{
    /**
     * @var Collection|TagInterface[]
     */
    protected $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return TagInterface[]
     */
    public function getTags()
    {
        return $this->tags->toArray();
    }

    /**
     * @param Collection|TagInterface[] $tags
     */
    public function setTags(Collection $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param TagInterface $tag
     *
     * @return bool
     */
    public function hasTag(TagInterface $tag)
    {
        return $this->tags->contains($tag);
    }

    /**
     * @param TagInterface $tag
     */
    public function addTag(TagInterface $tag)
    {
        if (!$this->hasTag($tag)) {
            $this->tags->add($tag);
        }
    }

    /**
     * @param TagInterface $tag
     */
    public function removeTag(TagInterface $tag)
    {
        if ($this->hasTag($tag)) {
            $this->tags->removeElement($tag);
        }
    }
}
