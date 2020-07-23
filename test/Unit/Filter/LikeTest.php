<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Filter;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter\Like;
use Lctrs\DBALSpecification\Operand\Field;
use Lctrs\DBALSpecification\Operand\LikePattern;
use PHPUnit\Framework\TestCase;

final class LikeTest extends TestCase
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

    public function testItCallsLike(): void
    {
        self::assertSame(
            'foo LIKE :dcValue1',
            (new Like(new Field('foo'), new LikePattern('bar')))->getFilter($this->queryBuilder)
        );
        self::assertSame(
            '%bar%',
            $this->queryBuilder->getParameter('dcValue1')
        );
    }

    public function testItUsesAlias(): void
    {
        self::assertSame(
            'x.foo LIKE :dcValue1',
            (new Like(new Field('x.foo'), new LikePattern('bar')))->getFilter($this->queryBuilder)
        );
        self::assertSame(
            '%bar%',
            $this->queryBuilder->getParameter('dcValue1')
        );
    }
}
