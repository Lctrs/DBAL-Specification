<?php

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class IsNull implements Filter
{
    private $field;
    private $alias;

    public function __construct(string $field, ?string $alias = null)
    {
        $this->field = $field;
        $this->alias = $alias;
    }

    public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null): ?string
    {
        if (null !== $this->alias) {
            $alias = $this->alias;
        }

        return $queryBuilder->expr()->isNull(sprintf('%s.%s', $alias, $this->field));
    }
}
