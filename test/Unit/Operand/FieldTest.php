<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Operand;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Operand\Field;
use PHPUnit\Framework\TestCase;

final class FieldTest extends TestCase
{
    /** @var QueryBuilder */
    private $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    public function testItReturnsField(): void
    {
        self::assertSame(
            'field',
            (new Field('field'))->transform($this->queryBuilder)
        );
    }
}
