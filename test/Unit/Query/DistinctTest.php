<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\Distinct;
use PHPUnit\Framework\TestCase;

final class DistinctTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    public function testItSetsDistinct(): void
    {
        (new Distinct())->modify($this->queryBuilder);

        self::assertTrue($this->queryBuilder->getQueryPart('distinct'));
    }
}
