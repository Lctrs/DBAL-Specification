<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

final class Limit implements QueryModifier
{
    /** @var int */
    private $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null) : void
    {
        $queryBuilder->setMaxResults($this->limit);
    }
}
