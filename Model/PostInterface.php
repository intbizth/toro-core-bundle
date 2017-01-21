<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Channel\Model\ChannelAwareInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Toro\Bundle\CmsBundle\Model\BlameableInterface;
use Toro\Bundle\CmsBundle\Model\PostInterface as BasePostInterface;
use Toro\Bundle\MediaBundle\Model\ImageCollectionAwareInterface;

interface PostInterface extends BasePostInterface, BlameableInterface, ChannelAwareInterface, ImageCollectionAwareInterface
{
    /**
     * @return TaxonInterface
     */
    public function getTaxon();

    /**
     * @param TaxonInterface $taxon
     */
    public function setTaxon(TaxonInterface $taxon = null);
}
