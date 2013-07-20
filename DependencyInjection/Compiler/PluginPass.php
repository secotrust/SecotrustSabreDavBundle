<?php

/*
 * This file is part of the SecotrustSabreDavBundle package.
 *
 * (c) Henrik Westphal <henrik.westphal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Secotrust\Bundle\SabreDavBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class PluginPass
 */
class PluginPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $serverDefinition = $container->getDefinition('secotrust.sabredav.server');
        $fileSystem = new FileSystem();
        foreach ($container->findTaggedServiceIds('secotrust.sabredav.plugin') as $id => $attr) {
            $serverDefinition->addMethodCall('addPlugin', array(new Reference($id)));
            switch ($id) {
                case 'secotrust.sabredav_lock_plugin':
                    $definition = $container->getDefinition('secotrust.sabredav_lock_backend');
                    $file = $container->getParameterBag()->resolveValue($definition->getArgument(0));
                    $fileSystem->mkdir(dirname($file));
                    break;
                case 'secotrust.sabredav_temp_plugin':
                    $definition = $container->getDefinition('secotrust.sabredav_temp_plugin');
                    $dir = $container->getParameterBag()->resolveValue($definition->getArgument(0));
                    $fileSystem->mkdir($dir);
                    break;
            }
        }
    }
}
