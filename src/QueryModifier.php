<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Query\QueryBuilder;

interface QueryModifier
{
    public function modify(QueryBuilder $queryBuilder): void;
}
