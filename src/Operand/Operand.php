<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Operand;

use Doctrine\DBAL\Query\QueryBuilder;

interface Operand
{
    public function transform(QueryBuilder $queryBuilder) : string;
}
