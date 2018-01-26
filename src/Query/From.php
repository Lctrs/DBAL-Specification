<?php

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class From implements QueryModifier
{
    private $table;
    private $alias;

    public function __construct(string $table, ?string $alias = null)
    {
        $this->table = $table;
        $this->alias = $alias;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void
    {
        if (null !== $this->alias) {
            $alias = $this->alias;
        }

        $queryBuilder->from($this->table, $alias);
    }
}
