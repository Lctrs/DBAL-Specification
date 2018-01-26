<?php

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class OrderBy implements QueryModifier
{
    private $field;
    private $order;
    private $alias;

    public function __construct(string $field, string $order = 'ASC', ?string $alias = null)
    {
        $this->field = $field;
        $this->order = $order;
        $this->alias = $alias;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void
    {
        if (null !== $this->alias) {
            $alias = $this->alias;
        }

        $queryBuilder->addOrderBy(sprintf('%s.%s', $alias, $this->field), $this->order);
    }
}
