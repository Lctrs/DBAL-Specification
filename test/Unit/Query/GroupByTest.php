<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\GroupBy;
use PHPUnit\Framework\TestCase;

final class GroupByTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    public function testItAddsGroupBy(): void
    {
        (new GroupBy('foo'))->modify($this->queryBuilder);

        self::assertSame(
            ['foo'],
            $this->queryBuilder->getQueryPart('groupBy')
        );
    }

    public function testItUsesAlias(): void
    {
        (new GroupBy('x.foo'))->modify($this->queryBuilder);

        self::assertSame(
            ['x.foo'],
            $this->queryBuilder->getQueryPart('groupBy')
        );
    }
}
