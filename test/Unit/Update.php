<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

final class Update implements QueryModifier
{
    public function modify(QueryBuilder $queryBuilder) : void
    {
        $queryBuilder->update('foo');
    }
}
