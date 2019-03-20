<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Exception;

use function sprintf;

class UnsupportedQueryTypeException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct(sprintf('Only "SELECT" queries are supported.'));
    }
}
