<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Taxonomy\Model\Taxon as BaseTaxon;

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
    public function createTranslation()
    {
        return new TaxonTranslation();
    }
}
