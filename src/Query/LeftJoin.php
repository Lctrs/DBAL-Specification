<?php

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class LeftJoin extends AbstractJoin
{
    protected function doJoin(QueryBuilder $queryBuilder, string $alias): void
    {
        $queryBuilder->leftJoin($alias, $this->join, $this->alias, $this->condition->getFilter($queryBuilder, $alias));
    }
}
