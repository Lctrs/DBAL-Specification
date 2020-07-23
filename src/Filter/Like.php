<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Operand\LikePattern;
use Lctrs\DBALSpecification\Operand\Operand;

final class Like implements Filter
{
    /** @var Operand */
    private $x;
    /** @var LikePattern */
    private $value;

    public function __construct(Operand $x, LikePattern $value)
    {
        $this->x     = $x;
        $this->value = $value;
    }

    public function getFilter(QueryBuilder $queryBuilder): ?string
    {
        return $queryBuilder->expr()->like(
            $this->x->transform($queryBuilder),
            $this->value->transform($queryBuilder)
        );
    }
}
