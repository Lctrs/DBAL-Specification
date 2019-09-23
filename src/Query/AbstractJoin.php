<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Exception\MissingRequiredAlias;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;

abstract class AbstractJoin implements QueryModifier
{
    /** @var string */
    protected $join;
    /** @var string */
    protected $alias;
    /** @var string|null */
    protected $fromAlias;
    /** @var Filter */
    protected $condition;

    public function __construct(string $join, string $alias, Filter $condition, ?string $fromAlias = null)
    {
        $this->join      = $join;
        $this->alias     = $alias;
        $this->condition = $condition;
        $this->fromAlias = $fromAlias;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null) : void
    {
        if ($this->fromAlias !== null) {
            $alias = $this->fromAlias;
        }

        if ($alias === null) {
            throw MissingRequiredAlias::fromJoin();
        }

        $this->doJoin($queryBuilder, $alias);
    }

    abstract protected function doJoin(QueryBuilder $queryBuilder, string $alias) : void;
}
