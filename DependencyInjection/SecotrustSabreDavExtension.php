<?php

/*
 * This file is part of the SecotrustSabreDavBundle package.
 *
 * (c) Henrik Westphal <henrik.westphal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Secotrust\Bundle\SabreDavBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class SecotrustSabreDavExtension
 */
class SecotrustSabreDavExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services/services.xml');

        if ($config['base_uri']) {
            $container->getDefinition('secotrust.sabredav.server')->addMethodCall('setBaseUri', array($config['base_uri']));
        }

        if ($config['root_dir']) {
            $container->getDefinition('secotrust.sabredav_root')->replaceArgument(0, $config['root_dir']);
        } else {
            $container->getDefinition('secotrust.sabredav_root')->clearTag('secotrust.sabredav.collection');
        }

        foreach ($config['plugins'] as $plugin => $enabled) {
            if ($enabled) {
                $loader->load(sprintf('services/plugins/%s.xml', $plugin));
            }
        }
    }
}
