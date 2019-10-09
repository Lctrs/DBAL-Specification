<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\Join;
use PHPUnit\Framework\TestCase;

abstract class JoinTest extends TestCase
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

    public function testItJoins() : void
    {
        $this->getJoin()->modify($this->queryBuilder);

        self::assertSame(
            $this->getExpectedQueryPart(),
            $this->queryBuilder->getQueryPart('join')
        );
    }

    abstract protected function getJoin() : Join;

    /**
     * @return mixed[]
     */
    abstract protected function getExpectedQueryPart() : array;
}
