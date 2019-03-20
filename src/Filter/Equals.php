<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

final class Equals extends Comparison
{
    public function __construct(string $field, string $value, ?string $alias = null)
    {
        parent::__construct(self::EQ, $field, $value, $alias);
    }
}
