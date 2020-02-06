<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;

final class Having implements QueryModifier
{
    /** @var Filter */
    private $filter;

    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
    }

    public function modify(QueryBuilder $queryBuilder) : void
    {
        $filter = $this->filter->getFilter($queryBuilder);
        if ($filter === null) {
            return;
        }

        $queryBuilder->having($filter);
    }
}
