<?php

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
abstract class BaseSpecification implements Specification
{
    private $alias;

    public function __construct(?string $alias = null)
    {
        $this->alias = $alias;
    }

    final public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null): ?string
    {
        $spec = $this->getSpec();
        if (!$spec instanceof Filter) {
            return null;
        }

        return $spec->getFilter($queryBuilder, $this->getAlias($alias));
    }

    final public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void
    {
        $spec = $this->getSpec();
        if (!$spec instanceof QueryModifier) {
            return;
        }

        $spec->modify($queryBuilder, $this->getAlias($alias));
    }

    abstract protected function getSpec(): Specification;

    private function getAlias(?string $alias = null): ?string
    {
        if (null !== $this->alias) {
            return $this->alias;
        }

        return $alias;
    }
}
