<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Taxonomy\Model\TaxonTranslation as BaseTaxonTranslation;

class TaxonTranslation extends BaseTaxonTranslation
{
    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        if (!$this->slug) {
            $this->setSlug($name);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug = null)
    {
        $this->slug = preg_replace('/\s+/', '-', strtolower(trim($slug)));
    }
}
