<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Operand;

use Doctrine\DBAL\Query\QueryBuilder;

final class Value implements Operand
{
    /** @var mixed */
    private $value;
    /** @var mixed */
    private $type;

    /**
     * @param mixed $value
     * @param mixed $type  One of Doctrine\DBAL\ParameterType::* or \Doctrine\DBAL\Types\Types::* constant
     */
    public function __construct($value, $type = null)
    {
        $this->value = $value;
        $this->type  = $type;
    }

    public function transform(QueryBuilder $queryBuilder) : string
    {
        return $queryBuilder->createNamedParameter($this->value, $this->type);
    }
}
