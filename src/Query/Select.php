<?php

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class Select implements QueryModifier
{
    private $field;
    private $alias;

    public function __construct(string $field, ?string $alias = null)
    {
        $this->field = $field;
        $this->alias = $alias;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void
    {
        if (null !== $this->alias) {
            $alias = $this->alias;
        }

        $queryBuilder->addSelect(sprintf('%s.%s', $alias, $this->field));
    }
}
