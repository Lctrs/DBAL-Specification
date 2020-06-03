<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;

final class InnerJoin extends Join
{
    protected function doJoin(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->innerJoin(
            $this->fromAlias,
            $this->join,
            $this->alias,
            $this->condition->getFilter($queryBuilder)
        );
    }
}
