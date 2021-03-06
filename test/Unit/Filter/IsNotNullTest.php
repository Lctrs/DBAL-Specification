<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Filter;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter\IsNotNull;
use Lctrs\DBALSpecification\Operand\Field;
use PHPUnit\Framework\TestCase;

final class IsNotNullTest extends TestCase
{
    /** @var QueryBuilder */
    private $queryBuilder;

    protected function setUp(): void
    {
        $connection  = $this->createMock(Connection::class);
        $exprBuilder = new ExpressionBuilder($connection);

        $connection
            ->expects(self::any())
            ->method('getExpressionBuilder')
            ->willReturn($exprBuilder);

        $this->queryBuilder = new QueryBuilder($connection);
    }

    public function testItCallsNotNull(): void
    {
        self::assertSame(
            'foo IS NOT NULL',
            (new IsNotNull(new Field('foo')))->getFilter($this->queryBuilder)
        );
    }

    public function testItUsesAlias(): void
    {
        self::assertSame(
            'x.foo IS NOT NULL',
            (new IsNotNull(new Field('x.foo')))->getFilter($this->queryBuilder)
        );
    }
}
