<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\From;
use PHPUnit\Framework\TestCase;

final class FromTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    public function testItAddsFrom(): void
    {
        (new From('foo'))->modify($this->queryBuilder);

        self::assertSame(
            [
                [
                    'table' => 'foo',
                    'alias' => null,
                ],
            ],
            $this->queryBuilder->getQueryPart('from')
        );
    }

    public function testItUsesAlias(): void
    {
        (new From('foo', 'x'))->modify($this->queryBuilder);

        self::assertSame(
            [
                0 => [
                    'table' => 'foo',
                    'alias' => 'x',
                ],
            ],
            $this->queryBuilder->getQueryPart('from')
        );
    }
}
