<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Toro\Bundle\CmsBundle\Model\BlameableTrait;
use Toro\Bundle\CmsBundle\Model\ChannelableTrait;
use Toro\Bundle\CmsBundle\Model\Post as BasePost;
use Toro\Bundle\MediaBundle\Model\ImageCollectionAwareTrait;

class Post extends BasePost implements PostInterface
{
    use BlameableTrait;
    use ChannelableTrait;
    use ImageCollectionAwareTrait;

    /**
     * @var TaxonInterface
     */
    protected $taxon;

    /**
     * @var Collection|PostFlaggedInterface[]
     */
    protected $flaggeds;

    public function __construct()
    {
        parent::__construct();

        $this->flaggeds = new ArrayCollection();

        $this->initializeImageCollection();
    }

    /**
     * {@inheritdoc}
     */
    public static function getImageCollectionTargetEntity()
    {
        return PostImageCollectionInterface::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxon()
    {
        return $this->taxon;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxon(TaxonInterface $taxon = null)
    {
        $this->taxon = $taxon;
    }

    /**
     * {@inheritdoc}
     */
    public function getTags()
    {
        return $this->getTranslation()->getTags();
    }

    /**
     * {@inheritdoc}
     */
    public function getFlaggeds()
    {
        return $this->flaggeds;
    }

    /**
     * {@inheritdoc}
     */
    public function getFlaggedTypes()
    {
        return array_map(function (PostFlaggedInterface $flagged) {
            return $flagged->getType();
        }, $this->flaggeds->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function addFlagged(PostFlaggedInterface $flagged)
    {
        if (!$this->hasFlagged($flagged)) {
            $flagged->setPost($this);
            $this->flaggeds->add($flagged);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeFlagged(PostFlaggedInterface $flagged)
    {
        if ($this->hasFlagged($flagged)) {
            $flagged->setPost(null);
            $this->flaggeds->removeElement($flagged);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasFlagged(PostFlaggedInterface $flagged)
    {
        return $this->flaggeds->contains($flagged);
    }
}
