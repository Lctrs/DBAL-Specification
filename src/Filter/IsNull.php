<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use function sprintf;

final class IsNull implements Filter
{
    /** @var string */
    private $field;
    /** @var string|null */
    private $alias;

    public function __construct(string $field, ?string $alias = null)
    {
        $this->field = $field;
        $this->alias = $alias;
    }

    public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null) : ?string
    {
        if ($this->alias !== null) {
            $alias = $this->alias;
        }

        return $queryBuilder->expr()->isNull(sprintf('%s.%s', $alias, $this->field));
    }
}
