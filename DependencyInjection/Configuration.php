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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('secotrust_sabre_dav');

        // TODO needs "little" improvement ;-)

        $rootNode
            ->children()
                ->scalarNode('root_dir')->example('%kernel.root_dir%/../web/dav')->isRequired()->end()
                ->scalarNode('base_uri')->example('/app_dev.php/dav/')->isRequired()->end()
                ->scalarNode('htdigest')->example('%kernel.root_dir%/../.htdigest')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}
