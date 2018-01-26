<?php

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class RightJoin extends AbstractJoin
{
    protected function doJoin(QueryBuilder $queryBuilder, string $alias): void
    {
        $queryBuilder->rightJoin($alias, $this->join, $this->alias, $this->condition->getFilter($queryBuilder, $alias));
    }
}
