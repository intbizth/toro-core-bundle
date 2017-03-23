<?php

namespace Toro\Bundle\CoreBundle\Model;

use Toro\Bundle\CmsBundle\Model\FlaggedInterface;

interface PostFlaggedInterface extends FlaggedInterface
{
    /**
     * @return PostInterface
     */
    public function getPost();

    /**
     * @param PostInterface $post
     */
    public function setPost(PostInterface $post = null);
}
