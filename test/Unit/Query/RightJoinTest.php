<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Query\Join;
use Lctrs\DBALSpecification\Query\RightJoin;

final class RightJoinTest extends JoinTest
{
    protected function getJoin(): Join
    {
        return new RightJoin(
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
                    'joinType' => 'right',
                    'joinTable' => 'foo',
                    'joinAlias' => 'f',
                    'joinCondition' => 'x.bar IS NULL',
                ],
            ],
        ];
    }
}
