<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\QueryModifier;
use function sprintf;

final class Select implements QueryModifier
{
    /** @var string */
    private $field;
    /** @var string|null */
    private $alias;

    public function __construct(string $field, ?string $alias = null)
    {
        $this->field = $field;
        $this->alias = $alias;
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null) : void
    {
        if ($this->alias !== null) {
            $alias = $this->alias;
        }

        $queryBuilder->addSelect(sprintf('%s.%s', $alias, $this->field));
    }
}
