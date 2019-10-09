<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;

final class LessThanOrEqual extends Comparison
{
    protected function doComparison(QueryBuilder $queryBuilder, string $x, string $y) : string
    {
        return $queryBuilder->expr()->lte($x, $y);
    }
}
