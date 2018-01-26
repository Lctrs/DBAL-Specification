<?php

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
interface Filter
{
    public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null): ?string;
}
