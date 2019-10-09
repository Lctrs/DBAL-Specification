<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\Select;
use PHPUnit\Framework\TestCase;

final class SelectTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp() : void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    public function testItAddsSelect() : void
    {
        (new Select('foo'))->modify($this->queryBuilder);

        self::assertSame(
            ['foo'],
            $this->queryBuilder->getQueryPart('select')
        );
    }

    public function testItUsesAlias() : void
    {
        (new Select('x.foo'))->modify($this->queryBuilder);

        self::assertSame(
            ['x.foo'],
            $this->queryBuilder->getQueryPart('select')
        );
    }
}
