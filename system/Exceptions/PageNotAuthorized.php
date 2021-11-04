<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter\Exceptions;

use OutOfBoundsException;

class PageNotAuthorized extends OutOfBoundsException implements ExceptionInterface
{
    use DebugTraceableTrait;

    /**
     * Error code
     *
     * @var int
     */
    protected $code = 401;
}
