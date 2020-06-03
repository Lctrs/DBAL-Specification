<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\OrderBy;
use PHPUnit\Framework\TestCase;

final class OrderByTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    public function testItAddsOrderBy(): void
    {
        (new OrderBy('foo'))->modify($this->queryBuilder);

        self::assertSame(
            ['foo ASC'],
            $this->queryBuilder->getQueryPart('orderBy')
        );
    }

    public function testItUsesAlias(): void
    {
        (new OrderBy('x.foo', 'DESC'))->modify($this->queryBuilder);

        self::assertSame(
            ['x.foo DESC'],
            $this->queryBuilder->getQueryPart('orderBy')
        );
    }
}
