<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Query\InnerJoin;
use Lctrs\DBALSpecification\Query\Join;

final class InnerJoinTest extends JoinTest
{
    protected function getJoin() : Join
    {
        return new InnerJoin(
            'x',
            'foo',
            'f',
            new Filter\IsNull('x.bar')
        );
    }

    /**
     * @return mixed[]
     */
    protected function getExpectedQueryPart() : array
    {
        return [
            'x' => [
                [
                    'joinType' => 'inner',
                    'joinTable' => 'foo',
                    'joinAlias' => 'f',
                    'joinCondition' => 'x.bar IS NULL',
                ],
            ],
        ];
    }
}
