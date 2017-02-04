<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Resource\Model\TimestampableTrait;

class PostFlagged implements PostFlaggedInterface
{
    use TimestampableTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var PostFlaggedTypeInterface
     */
    protected $type;

    /**
     * @var integer
     */
    protected $position = 0;

    /**
     * @var PostInterface
     */
    protected $post;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(PostFlaggedTypeInterface $type = null)
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * {@inheritdoc}
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * {@inheritdoc}
     */
    public function setPost(PostInterface $post = null)
    {
        $this->post = $post;
    }
}
