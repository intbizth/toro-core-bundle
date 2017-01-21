<?php

namespace Toro\Bundle\CoreBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Toro\Bundle\CoreBundle\ToroCoreBundle;

class ToroCoreExtension extends AbstractResourceExtension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration($config, $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $this->registerResources(ToroCoreBundle::APPLICATION_NAME, $config['driver'], $config['resources'], $container);

        $container->setParameter('toro_post_taxon_root', $config['post_taxon_root']);

        $loader->load('services.xml');
    }
}
