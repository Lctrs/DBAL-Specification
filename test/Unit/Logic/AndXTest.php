<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Logic;

use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Logic\AndX;
use Lctrs\DBALSpecification\Logic\LogicX;
use Lctrs\DBALSpecification\Query\From;

final class AndXTest extends LogicXTest
{
    protected function getLogicX() : LogicX
    {
        return new AndX([
            new Filter\IsNull('foo'),
            new From('aTable'),
            new Filter\IsNull('bar'),
        ]);
    }

    protected function getExpected() : string
    {
        return '(foo IS NULL) AND (bar IS NULL)';
    }

    /**
     * @return mixed[]
     */
    protected function getExpectedQueryParts() : array
    {
        return [
            'select' => [],
            'from' => [
                0 => [
                    'table' => 'aTable',
                    'alias' => null,
                ],
            ],
            'join' => [],
            'set' => [],
            'where' => null,
            'groupBy' => [],
            'having' => null,
            'orderBy' => [],
            'values' => [],
        ];
    }
}
