<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;

final class OrderBy implements QueryModifier
{
    /** @var string */
    private $field;
    /** @var string */
    private $order;

    public function __construct(string $field, string $order = 'ASC')
    {
        $this->field = $field;
        $this->order = $order;
    }

    public function modify(QueryBuilder $queryBuilder) : void
    {
        $queryBuilder->addOrderBy($this->field, $this->order);
    }
}
