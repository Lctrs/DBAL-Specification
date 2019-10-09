<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Operand\Operand;

abstract class Comparison implements Filter
{
    /** @var Operand */
    protected $x;
    /** @var Operand */
    protected $y;

    public function __construct(Operand $x, Operand $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    final public function getFilter(QueryBuilder $queryBuilder) : ?string
    {
        return $this->doComparison(
            $queryBuilder,
            $this->x->transform($queryBuilder),
            $this->y->transform($queryBuilder)
        );
    }

    abstract protected function doComparison(
        QueryBuilder $queryBuilder,
        string $x,
        string $y
    ) : string;
}
