<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface PostFlaggedTypeInterface extends CodeAwareInterface, ResourceInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return array
     */
    public function getConfig();

    /**
     * @param array $config
     */
    public function setConfig(array $config = array());

    /**
     * @return boolean
     */
    public function isEnabled();

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled);

    /**
     * @return boolean
     */
    public function isSingleActive();

    /**
     * @param boolean $singleActive
     */
    public function setSingleActive($singleActive);

    /**
     * @return Collection|PostFlaggedInterface[]
     */
    public function getItems();

    /**
     * @param Collection|PostFlaggedInterface[] $items
     */
    public function setItems(Collection $items);

    /**
     * @param PostFlaggedInterface $item
     *
     * @return bool
     */
    public function hasItem(PostFlaggedInterface $item);

    /**
     * @param PostFlaggedInterface $item
     */
    public function addItem(PostFlaggedInterface $item);

    /**
     * @param PostFlaggedInterface $item
     */
    public function removeItem(PostFlaggedInterface $item);
}
