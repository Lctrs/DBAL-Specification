<?php

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
interface QueryModifier
{
    public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void;
}
