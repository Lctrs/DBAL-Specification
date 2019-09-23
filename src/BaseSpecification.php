<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Query\QueryBuilder;

abstract class BaseSpecification implements Specification
{
    /** @var string|null */
    private $alias;

    public function __construct(?string $alias = null)
    {
        $this->alias = $alias;
    }

    final public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null) : ?string
    {
        $spec = $this->getSpec();
        if (! $spec instanceof Filter) {
            return null;
        }

        return $spec->getFilter($queryBuilder, $this->getAlias($alias));
    }

    final public function modify(QueryBuilder $queryBuilder, ?string $alias = null) : void
    {
        $spec = $this->getSpec();
        if (! $spec instanceof QueryModifier) {
            return;
        }

        $spec->modify($queryBuilder, $this->getAlias($alias));
    }

    /**
     * @return Filter|QueryModifier
     */
    abstract protected function getSpec();

    private function getAlias(?string $alias = null) : ?string
    {
        if ($this->alias !== null) {
            return $this->alias;
        }

        return $alias;
    }
}
