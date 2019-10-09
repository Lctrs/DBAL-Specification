<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;

final class IsNull implements Filter
{
    /** @var string */
    private $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function getFilter(QueryBuilder $queryBuilder) : ?string
    {
        return $queryBuilder->expr()->isNull($this->field);
    }
}
