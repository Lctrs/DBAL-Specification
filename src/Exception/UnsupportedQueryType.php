<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Exception;

use InvalidArgumentException;

final class UnsupportedQueryType extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Only "SELECT" queries are supported.');
    }
}
