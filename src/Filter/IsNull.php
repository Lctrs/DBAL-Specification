<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Operand\Operand;

final class IsNull implements Filter
{
    /** @var Operand */
    private $x;

    public function __construct(Operand $x)
    {
        $this->x = $x;
    }

    public function getFilter(QueryBuilder $queryBuilder): ?string
    {
        return $queryBuilder->expr()->isNull($this->x->transform($queryBuilder));
    }
}
