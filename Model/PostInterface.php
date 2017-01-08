<?php
namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Channel\Model\ChannelAwareInterface;
use Toro\Bundle\CmsBundle\Model\BlameableInterface;
use Toro\Bundle\CmsBundle\Model\PostInterface as BasePostInterface;

interface PostInterface extends BasePostInterface, BlameableInterface, ChannelAwareInterface
{
}
