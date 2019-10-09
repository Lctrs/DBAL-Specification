<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\Limit;
use PHPUnit\Framework\TestCase;

final class LimitTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp() : void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    public function testItSetsLimit() : void
    {
        (new Limit(10))->modify($this->queryBuilder);

        self::assertSame(
            10,
            $this->queryBuilder->getMaxResults()
        );
    }
}
