<?php

/*
 * This file is part of the SecotrustSabreDavBundle package.
 *
 * (c) Henrik Westphal <henrik.westphal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Secotrust\Bundle\SabreDavBundle;

use Secotrust\Bundle\SabreDavBundle\DependencyInjection\Compiler\CollectionPass;
use Secotrust\Bundle\SabreDavBundle\DependencyInjection\Compiler\PluginPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class SecotrustSabreDavBundle
 */
class SecotrustSabreDavBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new CollectionPass());
        $container->addCompilerPass(new PluginPass());
    }
}
