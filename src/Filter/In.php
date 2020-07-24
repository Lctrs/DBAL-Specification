<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Operand\Operand;

final class In implements Filter
{
    /** @var Operand */
    private $x;
    /** @var list<string> */
    private $y;

    /**
     * @param list<string> $y
     */
    public function __construct(Operand $x, array $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getFilter(QueryBuilder $queryBuilder): ?string
    {
        return $queryBuilder->expr()->in(
            $this->x->transform($queryBuilder),
            $queryBuilder->createNamedParameter($this->y, Connection::PARAM_STR_ARRAY)
        );
    }
}
