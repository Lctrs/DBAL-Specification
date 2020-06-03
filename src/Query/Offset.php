<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

final class Offset implements QueryModifier
{
    /** @var int */
    private $offset;

    public function __construct(int $offset)
    {
        $this->offset = $offset;
    }

    public function modify(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->setFirstResult($this->offset);
    }
}
