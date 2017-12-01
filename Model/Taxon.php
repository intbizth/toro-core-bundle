<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Taxonomy\Model\Taxon as BaseTaxon;
use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Sylius\Component\Taxonomy\Model\TaxonTranslation;

class Taxon extends BaseTaxon
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var Collection|PostInterface[]
     */
    protected $posts;

    public function __construct()
    {
        parent::__construct();

        $this->posts = new ArrayCollection();
    }

    /**
     * @return Collection|PostInterface[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     * {@internal}
     */
    public function createTranslation(): TaxonTranslation
    {
        return new TaxonTranslation();
    }

    /**
     * @param GeoNameInterface $geoName
     * @param array $names
     */
    private static function __getNames(TaxonInterface $taxon, array &$names)
    {
        if ($taxon->isRoot()) {
            return;
        }

        $names[] = $taxon->getName();

        if ($taxon->getParent()) {
            self::__getNames($taxon->getParent(), $names);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getPathName()
    {
        $names = [];

        self::__getNames($this, $names);

        return implode(', ', array_reverse($names));
    }
}
