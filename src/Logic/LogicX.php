<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Logic;

use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;
use Lctrs\DBALSpecification\Specification;

abstract class LogicX implements Specification
{
    /** @var Filter[]|QueryModifier[] */
    private $children;

    /**
     * @param Filter[]|QueryModifier[] $children
     */
    public function __construct(array $children = [])
    {
        $this->children = $children;
    }

    final public function getFilter(QueryBuilder $queryBuilder): ?string
    {
        $filters = [];
        foreach ($this->children as $child) {
            if (! $child instanceof Filter) {
                continue;
            }

            $filter = $child->getFilter($queryBuilder);
            if ($filter === null) {
                continue;
            }

            $filters[] = $filter;
        }

        return $this->doGetFilters(
            $queryBuilder->expr(),
            $filters
        );
    }

    final public function modify(QueryBuilder $queryBuilder): void
    {
        foreach ($this->children as $child) {
            if (! ($child instanceof QueryModifier)) {
                continue;
            }

            $child->modify($queryBuilder);
        }
    }

    /**
     * @param string[] $filters
     */
    abstract protected function doGetFilters(ExpressionBuilder $expressionBuilder, array $filters): ?string;
}
