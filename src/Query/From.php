<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

final class From implements QueryModifier
{
    /** @var string */
    private $table;
    /** @var string|null */
    private $alias;

    public function __construct(string $table, ?string $alias = null)
    {
        $this->table = $table;
        $this->alias = $alias;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null) : void
    {
        if ($this->alias !== null) {
            $alias = $this->alias;
        }

        $queryBuilder->from($this->table, $alias);
    }
}
