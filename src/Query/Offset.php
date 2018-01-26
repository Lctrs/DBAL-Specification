<?php

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

final class Offset implements QueryModifier
{
    private $offset;

    public function __construct(int $offset)
    {
        $this->offset = $offset;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void
    {
        $queryBuilder->setFirstResult($this->offset);
    }
}
