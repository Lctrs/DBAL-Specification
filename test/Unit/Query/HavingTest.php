<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Query\Having;
use PHPUnit\Framework\TestCase;

class HavingTest extends TestCase
{
    public function testItAddHaving() : void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->expects(self::once())
            ->method('having')
            ->with('a.foo = :bar');

        $filter = $this->createMock(Filter::class);
        $filter
            ->expects(self::once())
            ->method('getFilter')
            ->with($queryBuilder, 'a')
            ->willReturn('a.foo = :bar');

        (new Having($filter))->modify($queryBuilder, 'a');
    }
}
