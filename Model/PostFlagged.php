<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Resource\Model\TimestampableTrait;
use Toro\Bundle\CmsBundle\Model\Flagged;

class PostFlagged extends Flagged implements PostFlaggedInterface
{
    /**
     * @var PostInterface
     */
    protected $post;

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
