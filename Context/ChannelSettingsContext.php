<?php

namespace Toro\Bundle\CoreBundle\Context;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Toro\Bundle\CoreBundle\Model\ChannelInterface;
use Toro\Bundle\CoreBundle\Model\TaxonInterface;

class ChannelSettingsContext implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return ChannelInterface|\Sylius\Component\Channel\Model\ChannelInterface
     */
    public function getChannel()
    {
        return $this->container->get('sylius.context.channel')->getChannel();
    }

    /**
     * @return string
     */
    public function getLocaleCode()
    {
        return $this->container->get('sylius.context.locale')->getLocaleCode();
    }

    /**
     * @return array
     */
    public function all()
    {
        return (array)$this->getChannel()->getSettings();
    }

    /**
     * @param string $setting
     *
     * @return bool
     */
    public function has($setting)
    {
        $settings = $this->all();

        return array_key_exists($setting, $settings);
    }

    /**
     * @param string $setting
     * @param null $default
     *
     * @return mixed|null
     */
    public function get($setting, $default = null)
    {
        $settings = $this->all();

        if (array_key_exists($setting, $settings)) {
            return $settings[$setting];
        }

        return $default;
    }

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function getBranding($key)
    {
        $localeCode = $this->getLocaleCode();
        $defaults = (array)$this->container->getParameter('toro_branding');
        $settings = (array)$this->get('branding');
        $default = array_key_exists($key, $defaults) ? $defaults[$key] : null;

        if (array_key_exists($key, $settings)) {
            if (is_array($settings[$key])) {
                return array_key_exists($localeCode, $settings[$key]) ? $settings[$key][$localeCode] : $default;
            }

            return $settings[$key];
        }

        return $default;
    }

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function getEmails($key)
    {
        $emails = (array)$this->get('emails');

        return array_key_exists($key, $emails) ? $emails[$key] : null;
    }

    /**
     * @param string $key
     *
     * @return null|TaxonInterface
     */
    public function getTaxon($key)
    {
        $settings = (array)$this->get('taxon_codes');

        if (!array_key_exists($key, $settings)) {
            return;
        }

        return $this->container
            ->get('sylius.repository.taxon')
            ->findOneBy(['code' => $settings[$key]]);
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getTaxonCode($key)
    {
        $settings = (array)$this->get('taxon_codes');

        if (!array_key_exists($key, $settings)) {
            return;
        }

        return $settings[$key];
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->container->getParameter('toro_base_url');

    }
}
