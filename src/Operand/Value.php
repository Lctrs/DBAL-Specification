<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Operand;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Types\Type;

final class Value implements Operand
{
    /** @var mixed */
    private $value;
    /** @var int|string|Type|null */
    private $type;

    /**
     * @param mixed                $value
     * @param int|string|Type|null $type
     */
    public function __construct($value, $type = ParameterType::STRING)
    {
        $this->value = $value;
        $this->type  = $type;
    }

    public function transform(QueryBuilder $queryBuilder): string
    {
        return $queryBuilder->createNamedParameter($this->value, $this->type);
    }
}
