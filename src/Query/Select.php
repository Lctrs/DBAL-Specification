<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

final class Select implements QueryModifier
{
    /** @var string */
    private $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function modify(QueryBuilder $queryBuilder) : void
    {
        $queryBuilder->addSelect($this->field);
    }
}
