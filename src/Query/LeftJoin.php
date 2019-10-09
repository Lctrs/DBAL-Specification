<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;

final class LeftJoin extends Join
{
    protected function doJoin(QueryBuilder $queryBuilder) : void
    {
        $queryBuilder->leftJoin(
            $this->fromAlias,
            $this->join,
            $this->alias,
            $this->condition->getFilter($queryBuilder)
        );
    }
}
