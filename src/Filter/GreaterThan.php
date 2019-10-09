<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;

final class GreaterThan extends Comparison
{
    protected function doComparison(QueryBuilder $queryBuilder, string $x, string $y) : string
    {
        return $queryBuilder->expr()->gt($x, $y);
    }
}
