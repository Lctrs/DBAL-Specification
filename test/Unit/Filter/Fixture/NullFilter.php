<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Filter\Fixture;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;

final class NullFilter implements Filter
{
    public function getFilter(QueryBuilder $queryBuilder) : ?string
    {
        return null;
    }
}
