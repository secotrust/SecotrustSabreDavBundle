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

use Sabre\HTTP\Response as BaseResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class HttpResponse
 */
class HttpResponse extends BaseResponse
{
    /**
     * @var StreamedResponse
     */
    private $response;

    /**
     * Constructor
     *
     * @param StreamedResponse $response
     */
    public function __construct(StreamedResponse $response)
    {
        $this->response = $response; // TODO needed?
    }
}
