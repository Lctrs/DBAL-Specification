<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification;

use Lctrs\DBALSpecification\Filter\Equals;
use Lctrs\DBALSpecification\Filter\EqualsField;
use Lctrs\DBALSpecification\Filter\GreaterThan;
use Lctrs\DBALSpecification\Filter\GreaterThanOrEqual;
use Lctrs\DBALSpecification\Filter\IsNotNull;
use Lctrs\DBALSpecification\Filter\IsNull;
use Lctrs\DBALSpecification\Filter\LessThan;
use Lctrs\DBALSpecification\Filter\LessThanOrEqual;
use Lctrs\DBALSpecification\Filter\Like;
use Lctrs\DBALSpecification\Filter\NotEquals;
use Lctrs\DBALSpecification\Logic\AndX;
use Lctrs\DBALSpecification\Logic\OrX;
use Lctrs\DBALSpecification\Query\From;
use Lctrs\DBALSpecification\Query\GroupBy;
use Lctrs\DBALSpecification\Query\InnerJoin;
use Lctrs\DBALSpecification\Query\LeftJoin;
use Lctrs\DBALSpecification\Query\Limit;
use Lctrs\DBALSpecification\Query\Offset;
use Lctrs\DBALSpecification\Query\OrderBy;
use Lctrs\DBALSpecification\Query\RightJoin;
use Lctrs\DBALSpecification\Query\Select;

class Spec
{
    private function __construct()
    {
    }

    public static function select(string $field, ?string $alias = null) : Select
    {
        return new Select($field, $alias);
    }

    public static function from(string $table, ?string $alias = null) : From
    {
        return new From($table, $alias);
    }

    public static function eqField(
        string $leftAlias,
        string $leftField,
        string $rightAlias,
        string $rightField
    ) : EqualsField {
        return new EqualsField($leftAlias, $leftField, $rightAlias, $rightField);
    }

    public static function eq(string $field, string $value, ?string $alias = null) : Equals
    {
        return new Equals($field, $value, $alias);
    }

    public static function neq(string $field, string $value, ?string $alias = null) : NotEquals
    {
        return new NotEquals($field, $value, $alias);
    }

    public static function gt(string $field, string $value, ?string $alias = null) : GreaterThan
    {
        return new GreaterThan($field, $value, $alias);
    }

    public static function gte(string $field, string $value, ?string $alias = null) : GreaterThanOrEqual
    {
        return new GreaterThanOrEqual($field, $value, $alias);
    }

    public static function lt(string $field, string $value, ?string $alias = null) : LessThan
    {
        return new LessThan($field, $value, $alias);
    }

    public static function lte(string $field, string $value, ?string $alias = null) : LessThanOrEqual
    {
        return new LessThanOrEqual($field, $value, $alias);
    }

    public static function isNull(string $field, ?string $alias = null) : IsNull
    {
        return new IsNull($field, $alias);
    }

    public static function isNotNull(string $field, ?string $alias = null) : IsNotNull
    {
        return new IsNotNull($field, $alias);
    }

    public static function like(
        string $field,
        string $value,
        string $format = Like::CONTAINS,
        ?string $alias = null
    ) : Like {
        return new Like($field, $value, $format, $alias);
    }

    /**
     * @param Filter[]|QueryModifier[] ...$children
     */
    public static function andX(...$children) : AndX
    {
        return new AndX(...$children);
    }

    /**
     * @param Filter[]|QueryModifier[] ...$children
     */
    public static function orX(...$children) : OrX
    {
        return new OrX(...$children);
    }

    public static function innerJoin(
        string $join,
        string $alias,
        Filter $condition,
        ?string $fromAlias = null
    ) : InnerJoin {
        return new InnerJoin($join, $alias, $condition, $fromAlias);
    }

    public static function leftJoin(
        string $join,
        string $alias,
        Filter $condition,
        ?string $fromAlias = null
    ) : LeftJoin {
        return new LeftJoin($join, $alias, $condition, $fromAlias);
    }

    public static function rightJoin(
        string $join,
        string $alias,
        Filter $condition,
        ?string $fromAlias = null
    ) : RightJoin {
        return new RightJoin($join, $alias, $condition, $fromAlias);
    }

    public static function groupBy(string $field, ?string $alias = null) : GroupBy
    {
        return new GroupBy($field, $alias);
    }

    public static function orderBy(string $field, string $order = 'ASC', ?string $alias = null) : OrderBy
    {
        return new OrderBy($field, $order, $alias);
    }

    public static function limit(int $limit) : Limit
    {
        return new Limit($limit);
    }

    public static function offset(int $offset) : Offset
    {
        return new Offset($offset);
    }
}
