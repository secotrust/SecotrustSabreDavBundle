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
                ->scalarNode('root_dir')->example('%kernel.root_dir%/../web/dav')->defaultNull()->end()
                ->scalarNode('base_uri')->example('/app_dev.php/dav/')->isRequired()->end()
                ->arrayNode('plugins')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('acl')->defaultFalse()->end()
                        ->booleanNode('auth')->defaultFalse()->end()
                        ->booleanNode('browser')->defaultFalse()->end()
                        ->booleanNode('caldav')->defaultFalse()->end()
                        ->booleanNode('lock')->defaultTrue()->end()
                        ->booleanNode('temp')->defaultTrue()->end()
                        ->booleanNode('mount')->defaultFalse()->end()
                        ->booleanNode('patch')->defaultFalse()->end()
                        ->booleanNode('content_type')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
