<?php

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class Limit implements QueryModifier
{
    private $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void
    {
        $queryBuilder->setMaxResults($this->limit);
    }
}
