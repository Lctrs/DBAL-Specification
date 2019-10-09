<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\BaseSpecification;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Logic\AndX;
use Lctrs\DBALSpecification\Operand\Field;
use Lctrs\DBALSpecification\Query\Select;
use Lctrs\DBALSpecification\QueryModifier;
use PHPUnit\Framework\TestCase;

final class BaseSpecificationTest extends TestCase
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

    public function testItReturnsFilter() : void
    {
        self::assertSame(
            'bar = baz',
            $this->getFullSpecification()->getFilter($this->queryBuilder)
        );
    }

    public function testItModifiesQuery() : void
    {
        $this->getFullSpecification()->modify($this->queryBuilder);

        self::assertSame(
            ['foo'],
            $this->queryBuilder->getQueryPart('select')
        );
    }

    public function testItReturnsNoFilter() : void
    {
        self::assertNull($this->getModifierSpecification()->getFilter($this->queryBuilder));
    }

    public function testItDoesNotModifyQuery() : void
    {
        $this->getFilterSpecification()->modify($this->queryBuilder);

        self::assertSame(
            [
                'select' => [],
                'from' => [],
                'join' => [],
                'set' => [],
                'where' => null,
                'groupBy' => [],
                'having' => null,
                'orderBy' => [],
                'values' => [],
            ],
            $this->queryBuilder->getQueryParts()
        );
    }

    private function getFullSpecification() : BaseSpecification
    {
        return new class extends BaseSpecification {
            /**
             * @return Filter|QueryModifier
             */
            protected function getSpec()
            {
                return new AndX([
                    new Select('foo'),
                    new Filter\Equals(new Field('bar'), new Field('baz')),
                ]);
            }
        };
    }

    private function getFilterSpecification() : BaseSpecification
    {
        return new class extends BaseSpecification {
            /**
             * @return Filter|QueryModifier
             */
            protected function getSpec()
            {
                return new Filter\Equals(new Field('bar'), new Field('baz'));
            }
        };
    }

    private function getModifierSpecification() : BaseSpecification
    {
        return new class extends BaseSpecification {
            /**
             * @return Filter|QueryModifier
             */
            protected function getSpec()
            {
                return new Select('foo');
            }
        };
    }
}
