<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Logic;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Logic\LogicX;
use PHPUnit\Framework\TestCase;

abstract class LogicXTest extends TestCase
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

    public function testGetFilters() : void
    {
        self::assertSame(
            $this->getExpected(),
            $this->getLogicX()->getFilter($this->queryBuilder)
        );
    }

    public function testItModifies() : void
    {
        $this->getLogicX()->modify($this->queryBuilder);

        self::assertSame(
            $this->getExpectedQueryParts(),
            $this->queryBuilder->getQueryParts()
        );
    }

    abstract protected function getLogicX() : LogicX;

    abstract protected function getExpected() : string;

    /**
     * @return mixed[]
     */
    abstract protected function getExpectedQueryParts() : array;
}
