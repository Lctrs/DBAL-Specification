<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Filter;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter\Comparison;
use PHPUnit\Framework\TestCase;

abstract class ComparisonTest extends TestCase
{
    /** @var QueryBuilder */
    private $queryBuilder;

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

    public function testItDoesComparison() : void
    {
        self::assertSame(
            $this->getExpected(),
            $this->getComparison()->getFilter($this->queryBuilder)
        );
    }

    abstract protected function getComparison() : Comparison;

    abstract protected function getExpected() : string;
}
