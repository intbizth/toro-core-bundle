<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface PostFlaggedInterface extends ResourceInterface, TimestampableInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return PostFlaggedTypeInterface
     */
    public function getType();

    /**
     * @param PostFlaggedTypeInterface $type
     */
    public function setType(PostFlaggedTypeInterface $type = null);

    /**
     * @return int
     */
    public function getPosition();

    /**
     * @param int $position
     */
    public function setPosition($position);

    /**
     * @return PostInterface
     */
    public function getPost();

    /**
     * @param PostInterface $post
     */
    public function setPost(PostInterface $post = null);
}
