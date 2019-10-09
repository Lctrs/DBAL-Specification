<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;

abstract class Join implements QueryModifier
{
    /** @var string */
    protected $fromAlias;
    /** @var string */
    protected $join;
    /** @var string */
    protected $alias;
    /** @var Filter */
    protected $condition;

    public function __construct(string $fromAlias, string $join, string $alias, Filter $condition)
    {
        $this->fromAlias = $fromAlias;
        $this->join      = $join;
        $this->alias     = $alias;
        $this->condition = $condition;
    }

    public function modify(QueryBuilder $queryBuilder) : void
    {
        $this->doJoin($queryBuilder);
    }

    abstract protected function doJoin(QueryBuilder $queryBuilder) : void;
}
