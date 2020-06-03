<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Query\Join;
use Lctrs\DBALSpecification\Query\LeftJoin;

final class LeftJoinTest extends JoinTest
{
    protected function getJoin(): Join
    {
        return new LeftJoin(
            'x',
            'foo',
            'f',
            new Filter\IsNull('x.bar')
        );
    }

    /**
     * @return mixed[]
     */
    protected function getExpectedQueryPart(): array
    {
        return [
            'x' => [
                [
                    'joinType' => 'left',
                    'joinTable' => 'foo',
                    'joinAlias' => 'f',
                    'joinCondition' => 'x.bar IS NULL',
                ],
            ],
        ];
    }
}
