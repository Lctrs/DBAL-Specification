<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\Offset;
use PHPUnit\Framework\TestCase;

final class OffsetTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    public function testItSetsOffset(): void
    {
        (new Offset(10))->modify($this->queryBuilder);

        self::assertSame(
            10,
            $this->queryBuilder->getFirstResult()
        );
    }
}
