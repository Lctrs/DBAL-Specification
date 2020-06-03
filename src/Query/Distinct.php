<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

final class Distinct implements QueryModifier
{
    public function modify(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->distinct();
    }
}
