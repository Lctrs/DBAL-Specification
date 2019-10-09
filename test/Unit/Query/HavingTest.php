<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\CompositeExpression;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Query\Having;
use PHPUnit\Framework\TestCase;

final class HavingTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp() : void
    {
        $connection  = $this->createMock(Connection::class);
        $exprBuilder = new ExpressionBuilder($connection);

        $connection
            ->expects(self::any())
            ->method('getExpressionBuilder')
            ->willReturn($exprBuilder);

        $this->queryBuilder = new QueryBuilder($connection);
    }

    public function testItAddsHaving() : void
    {
        (new Having(new Filter\IsNull('foo')))->modify($this->queryBuilder);

        self::assertEquals(
            new CompositeExpression('AND', ['foo IS NULL']),
            $this->queryBuilder->getQueryPart('having')
        );
    }
}
