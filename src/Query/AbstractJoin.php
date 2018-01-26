<?php

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
abstract class AbstractJoin implements QueryModifier
{
    protected $join;
    protected $alias;
    protected $fromAlias;
    protected $condition;

    public function __construct(string $join, string $alias, Filter $condition, ?string $fromAlias = null)
    {
        $this->join = $join;
        $this->alias = $alias;
        $this->condition = $condition;
        $this->fromAlias = $fromAlias;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void
    {
        if (null !== $this->fromAlias) {
            $alias = $this->fromAlias;
        }

        $this->doJoin($queryBuilder, $alias);
    }

    abstract protected function doJoin(QueryBuilder $queryBuilder, string $alias): void;
}
