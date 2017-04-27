<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\User\Model\UserInterface as BaseUserInterface;
use Symfony\Cmf\Bundle\MediaBundle\ImageInterface;
use Toro\Bundle\MediaBundle\Model\MediaAwareInterface;

interface UserInterface extends BaseUserInterface, MediaAwareInterface
{
    /**
     * @return ImageInterface|null
     */
    public function getProfilePicture();

    /**
     * @param ImageInterface|null $profilePicture
     */
    public function setProfilePicture(ImageInterface $profilePicture = null);

    /**
     * @return string|null
     */
    public function getProfilePictureId();
}
