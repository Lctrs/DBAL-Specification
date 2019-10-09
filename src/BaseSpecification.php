<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Query\QueryBuilder;

abstract class BaseSpecification implements Specification
{
    final public function getFilter(QueryBuilder $queryBuilder) : ?string
    {
        $spec = $this->getSpec();
        if (! $spec instanceof Filter) {
            return null;
        }

        return $spec->getFilter($queryBuilder);
    }

    final public function modify(QueryBuilder $queryBuilder) : void
    {
        $spec = $this->getSpec();
        if (! $spec instanceof QueryModifier) {
            return;
        }

        $spec->modify($queryBuilder);
    }

    /**
     * @return Filter|QueryModifier
     */
    abstract protected function getSpec();
}
