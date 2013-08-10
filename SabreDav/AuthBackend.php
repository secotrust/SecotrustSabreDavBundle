<?php

/*
 * This file is part of the SecotrustSabreDavBundle package.
 *
 * (c) Henrik Westphal <henrik.westphal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Secotrust\Bundle\SabreDavBundle\SabreDav;

use Sabre\DAV\Auth\Backend\BackendInterface;
use Sabre\DAV\Exception;
use Sabre\DAV\Server;
use Symfony\Component\Security\Core\SecurityContextInterface;

class AuthBackend implements BackendInterface
{
    /**
     * @var SecurityContextInterface
     */
    private $context;

    /**
     * Constructor
     *
     * @param SecurityContextInterface $context
     */
    public function __construct(SecurityContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * @inheritdoc
     */
    public function authenticate(Server $server, $realm)
    {
        if (null === $this->context->getToken()) {
            throw new Exception('The security token is NULL');
        }

        return $this->context->getToken()->isAuthenticated();
    }

    /**
     * @inheritdoc
     */
    public function getCurrentUser()
    {
        return $this->context->getToken()->getUsername();
    }
}
