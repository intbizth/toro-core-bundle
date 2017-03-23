<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Toro\Bundle\CmsBundle\Model\BlameableTrait;
use Toro\Bundle\CmsBundle\Model\ChannelableTrait;
use Toro\Bundle\CmsBundle\Model\FlaggedAwareTrait;
use Toro\Bundle\CmsBundle\Model\Post as BasePost;
use Toro\Bundle\MediaBundle\Model\ImageCollectionAwareTrait;

class Post extends BasePost implements PostInterface
{
    use BlameableTrait;
    use ChannelableTrait;
    use ImageCollectionAwareTrait;
    use FlaggedAwareTrait;

    /**
     * @var TaxonInterface
     */
    protected $taxon;

    public function __construct()
    {
        parent::__construct();

        $this->flaggeds = new ArrayCollection();

        $this->initializeImageCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function createTranslation()
    {
        return new PostTranslation();
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
}
