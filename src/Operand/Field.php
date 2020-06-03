<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Operand;

use Doctrine\DBAL\Query\QueryBuilder;

final class Field implements Operand
{
    /** @var string */
    private $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function transform(QueryBuilder $queryBuilder): string
    {
        return $this->field;
    }
}
