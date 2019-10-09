<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Logic;

use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Logic\LogicX;
use Lctrs\DBALSpecification\Logic\OrX;
use Lctrs\DBALSpecification\Query\GroupBy;
use Lctrs\DBALSpecification\Query\OrderBy;

final class OrXTest extends LogicXTest
{
    protected function getLogicX() : LogicX
    {
        return new OrX([
            new OrderBy('baz'),
            new Filter\IsNull('foo'),
            new Filter\IsNull('bar'),
            new GroupBy('foo'),
        ]);
    }

    protected function getExpected() : string
    {
        return '(foo IS NULL) OR (bar IS NULL)';
    }

    /**
     * @return mixed[]
     */
    protected function getExpectedQueryParts() : array
    {
        return [
            'select' => [],
            'from' => [],
            'join' => [],
            'set' => [],
            'where' => null,
            'groupBy' => ['foo'],
            'having' => null,
            'orderBy' => ['baz ASC'],
            'values' => [],
        ];
    }
}