<?php

namespace Toro\Bundle\CoreBundle\Model;

use Sylius\Component\Channel\Model\ChannelInterface as BaseChannelInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Locale\Model\LocalesAwareInterface;

interface ChannelInterface extends
    BaseChannelInterface,
    LocalesAwareInterface
{
    /**
     * @return string
     */
    public function getThemeName();

    /**
     * @param string $themeName
     */
    public function setThemeName($themeName);

    /**
     * @param LocaleInterface $locale
     */
    public function setDefaultLocale(LocaleInterface $locale);

    /**
     * @return LocaleInterface
     */
    public function getDefaultLocale();

    /**
     * @return array
     */
    public function getSettings(): array;

    /**
     * @param array $settings
     */
    public function setSettings(array $settings);
}
