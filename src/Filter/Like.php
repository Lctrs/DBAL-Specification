<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Operand\LikePattern;

final class Like implements Filter
{
    /** @var string */
    private $field;
    /** @var LikePattern */
    private $value;

    public function __construct(string $field, LikePattern $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function getFilter(QueryBuilder $queryBuilder): ?string
    {
        return $queryBuilder->expr()->like(
            $this->field,
            $this->value->transform($queryBuilder)
        );
    }
}
