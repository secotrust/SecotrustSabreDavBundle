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

/**
 * Class CollectionPass
 */
class CollectionPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $serverDefinition = $container->getDefinition('secotrust.sabredav.server');
        $collections = array();
        foreach ($container->findTaggedServiceIds('secotrust.sabredav.collection') as $id => $attr) {
            $collections[] = new Reference($id);
        }
        if (1 === count($collections)) {
            $serverDefinition->replaceArgument(0, $collections[0]);
        } else {
            $serverDefinition->replaceArgument(0, $collections);
        }
    }
}
