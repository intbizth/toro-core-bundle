<?php

namespace Toro\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\Channel as BaseChannel;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface as BaseTaxonInterface;

class Channel extends BaseChannel implements ChannelInterface
{
    /**
     * @var LocaleInterface
     */
    protected $defaultLocale;

    /**
     * @var LocaleInterface[]|Collection
     */
    protected $locales;

    /**
     * @var string
     */
    protected $themeName;

    /**
     * @var array
     */
    protected $settings = [];

    public function __construct()
    {
        parent::__construct();

        $this->locales = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getThemeName()
    {
        return $this->themeName;
    }

    /**
     * {@inheritdoc}
     */
    public function setThemeName($themeName)
    {
        $this->themeName = $themeName;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultLocale(LocaleInterface $defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocales(): Collection
    {
        return $this->locales;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocales(Collection $locales)
    {
        $this->locales = $locales;
    }

    /**
     * {@inheritdoc}
     */
    public function addLocale(LocaleInterface $locale): void
    {
        if (!$this->hasLocale($locale)) {
            $this->locales->add($locale);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeLocale(LocaleInterface $locale): void
    {
        if ($this->hasLocale($locale)) {
            $this->locales->removeElement($locale);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasLocale(LocaleInterface $locale): bool
    {
        return $this->locales->contains($locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * {@inheritdoc}
     */
    public function setSettings(array $settings)
    {
        $this->settings = $settings;
    }
}
