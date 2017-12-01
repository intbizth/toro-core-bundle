<?php

namespace Toro\Bundle\CoreBundle;

use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Toro\Bundle\CoreBundle\DependencyInjection\Compiler\ProvinceTranslationResourcePass;

class ToroCoreBundle extends AbstractResourceBundle
{
    const APPLICATION_NAME = 'toro';

    /**
     * {@inheritdoc}
     */
    public function getSupportedDrivers(): array
    {
        return [
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelNamespace(): string
    {
        return 'Toro\Bundle\CoreBundle\Model';
    }
}
