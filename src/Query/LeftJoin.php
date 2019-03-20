<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;

final class LeftJoin extends AbstractJoin
{
    protected function doJoin(QueryBuilder $queryBuilder, string $alias) : void
    {
        $queryBuilder->leftJoin($alias, $this->join, $this->alias, $this->condition->getFilter($queryBuilder, $alias));
    }
}
