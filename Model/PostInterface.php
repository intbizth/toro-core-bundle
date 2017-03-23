<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelAwareInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Toro\Bundle\CmsBundle\Model\BlameableInterface;
use Toro\Bundle\CmsBundle\Model\FlaggedAwareInterface;
use Toro\Bundle\CmsBundle\Model\PostInterface as BasePostInterface;
use Toro\Bundle\MediaBundle\Model\ImageCollectionAwareInterface;
use Toro\Bundle\TaggingBundle\Model\TagInterface;

interface PostInterface extends
    BasePostInterface,
    BlameableInterface,
    ChannelAwareInterface,
    ImageCollectionAwareInterface,
    FlaggedAwareInterface
{
    /**
     * @return TaxonInterface
     */
    public function getTaxon();

    /**
     * @return TagInterface[]
     */
    public function getTags();

    /**
     * @param TaxonInterface $taxon
     */
    public function setTaxon(TaxonInterface $taxon = null);
}
