<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Exception;

use RuntimeException;

final class MissingRequiredAlias extends RuntimeException
{
    public static function fromJoin() : self
    {
        return new self('A join require an alias to be given for the joined table.');
    }
}
