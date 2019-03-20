<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Exception\InvalidArgumentException;
use Lctrs\DBALSpecification\Filter;
use function implode;
use function in_array;
use function sprintf;

class Comparison implements Filter
{
    public const EQ   = '=';
    public const NEQ  = '<>';
    public const LT   = '<';
    public const LTE  = '<=';
    public const GT   = '>';
    public const GTE  = '>=';
    public const LIKE = 'LIKE';

    /** @var string */
    protected $field;
    /** @var string */
    protected $value;
    /** @var string|null */
    protected $alias;

    /** @var string[] */
    private static $operators = [
        self::EQ,
        self::NEQ,
        self::LT,
        self::LTE,
        self::GT,
        self::GTE,
        self::LIKE,
    ];

    /** @var string */
    private $operator;

    public function __construct(string $operator, string $field, string $value, ?string $alias = null)
    {
        if (! in_array($operator, self::$operators)) {
            throw new InvalidArgumentException(sprintf(
                '"%s" is not a valid comparison operator. Valid operators are: "%s"',
                $operator,
                implode(', ', self::$operators)
            ));
        }

        $this->operator = $operator;
        $this->field    = $field;
        $this->value    = $value;
        $this->alias    = $alias;
    }

    public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null) : ?string
    {
        if ($this->alias !== null) {
            $alias = $this->alias;
        }

        $paramName = $queryBuilder->createNamedParameter($this->value);

        return sprintf('%s.%s %s %s', $alias, $this->field, $this->operator, $paramName);
    }
}
