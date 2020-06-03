<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Query\QueryBuilder;

interface Filter
{
    public function getFilter(QueryBuilder $queryBuilder): ?string;
}
