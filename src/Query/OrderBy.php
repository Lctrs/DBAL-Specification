<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;
use function sprintf;

final class OrderBy implements QueryModifier
{
    /** @var string */
    private $field;
    /** @var string */
    private $order;
    /** @var string|null */
    private $alias;

    public function __construct(string $field, string $order = 'ASC', ?string $alias = null)
    {
        $this->field = $field;
        $this->order = $order;
        $this->alias = $alias;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null) : void
    {
        if ($this->alias !== null) {
            $alias = $this->alias;
        }

        $queryBuilder->addOrderBy(sprintf('%s.%s', $alias, $this->field), $this->order);
    }
}
