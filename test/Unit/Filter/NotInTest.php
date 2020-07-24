<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Filter;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter\NotIn;
use Lctrs\DBALSpecification\Operand\Field;
use PHPUnit\Framework\TestCase;

final class NotInTest extends TestCase
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
        $connection
            ->expects(self::any())
            ->method('createQueryBuilder')
            ->willReturn(new QueryBuilder($connection));

        $this->queryBuilder = new QueryBuilder($connection);
    }

    public function testItCallsIn(): void
    {
        self::assertSame(
            'foo NOT IN (:dcValue1)',
            (new NotIn(new Field('foo'), ['foo', 'bar']))->getFilter($this->queryBuilder)
        );

        self::assertSame(
            $this->queryBuilder->getParameter('dcValue1'),
            ['foo', 'bar']
        );
    }
}
