<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class PostFlaggedType implements PostFlaggedTypeInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var array
     */
    protected $config = array();

    /**
     * @var boolean
     */
    protected $singleActive = false;

    /**
     * @var Collection|PostFlaggedInterface[]
     */
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config = array())
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function isSingleActive()
    {
        return $this->singleActive;
    }

    /**
     * {@inheritdoc}
     */
    public function setSingleActive($singleActive)
    {
        $this->singleActive = $singleActive;
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function setItems(Collection $items)
    {
        $this->items = $items;
    }

    /**
     * {@inheritdoc}
     */
    public function hasItem(PostFlaggedInterface $item)
    {
        return $this->items->contains($item);
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(PostFlaggedInterface $item)
    {
        if (!$this->hasItem($item)) {
            $item->setType($this);
            $this->items->add($item);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(PostFlaggedInterface $item)
    {
        if (!$this->hasItem($item)) {
            $item->setType(null);
            $this->items->removeElement($item);
        }
    }
}
