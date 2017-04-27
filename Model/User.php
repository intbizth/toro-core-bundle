<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\User\Model\User as BaseUser;
use Symfony\Cmf\Bundle\MediaBundle\ImageInterface;
use Toro\Bundle\MediaBundle\Meta\MediaReference;

abstract class User extends BaseUser implements UserInterface
{
    /**
     * @var \DateTime|null
     */
    protected $updatedAt;

    /**
     * @var ImageInterface
     */
    protected $profilePicture;

    /**
     * @var string
     */
    protected $profilePictureId;

    /**
     * {@inheritdoc}
     */
    public function getProfilePicture()
    {
        return MediaReference::getImage($this->profilePicture);
    }

    /**
     * {@inheritdoc}
     */
    public function setProfilePicture(ImageInterface $profilePicture = null)
    {
        $this->profilePicture = $profilePicture;
        $this->updatedAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getProfilePictureId()
    {
        return $this->profilePictureId;
    }

    /**
     * {@inheritdoc}
     */
    public function getMediaMetaReferences()
    {
        $reflect = new \ReflectionClass($this);
        $called = strtolower($reflect->getShortName());

        return [
            new MediaReference("/$called/" . $this->id, 'profilePictureId', $this->profilePictureId, $this->profilePicture)
        ];
    }
}
