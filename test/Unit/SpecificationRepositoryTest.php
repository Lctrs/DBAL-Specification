<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\ResultStatement;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\BaseSpecification;
use Lctrs\DBALSpecification\Exception\UnsupportedQueryType;
use Lctrs\DBALSpecification\Filter\Equals;
use Lctrs\DBALSpecification\Logic\AndX;
use Lctrs\DBALSpecification\Operand\Field;
use Lctrs\DBALSpecification\Operand\Value;
use Lctrs\DBALSpecification\Query\From;
use Lctrs\DBALSpecification\Query\Select;
use Lctrs\DBALSpecification\QueryModifier;
use Lctrs\DBALSpecification\SpecificationRepository;
use Lctrs\DBALSpecification\Test\Unit\Filter\Fixture\NullFilter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class SpecificationRepositoryTest extends TestCase
{
    /** @var Connection&MockObject */
    private $connection;
    /** @var SpecificationRepository */
    private $instance;

    protected function setUp(): void
    {
        $this->connection = $this->createMock(Connection::class);
        $queryBuilder     = new QueryBuilder($this->connection);
        $exprBuilder      = new ExpressionBuilder($this->connection);

        $this->connection
            ->expects(self::any())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilder);

        $this->connection
            ->expects(self::any())
            ->method('getExpressionBuilder')
            ->willReturn($exprBuilder);

        $this->instance = new class ($this->connection) extends SpecificationRepository {
        };
    }

    public function testNotSelectQueryThrowException(): void
    {
        $this->expectException(UnsupportedQueryType::class);
        $this->expectErrorMessage('Only "SELECT" queries are supported.');

        $this->instance->match(new class implements QueryModifier {
            public function modify(QueryBuilder $queryBuilder): void
            {
                $queryBuilder->update('foo');
            }
        });
    }

    public function testItMatchesQuery(): void
    {
        $this->connection->expects(self::once())
            ->method('executeQuery')
            ->with(
                'SELECT foo FROM bar WHERE baz = :dcValue1',
                ['dcValue1' => 'qux'],
                ['dcValue1' => 2]
            )
            ->willReturn($this->createMock(ResultStatement::class));

        $this->instance->match(new class extends BaseSpecification {
            /**
             * @inheritDoc
             */
            protected function getSpec()
            {
                return new AndX([
                    new Select('foo'),
                    new From('bar'),
                    new Equals(new Field('baz'), new Value('qux')),
                ]);
            }
        });
    }

    public function testANullFilterIsNotApplied(): void
    {
        $this->connection->expects(self::once())
            ->method('executeQuery')
            ->with(
                'SELECT ',
                [],
                []
            )
            ->willReturn($this->createMock(ResultStatement::class));

        $this->instance->match(new class extends BaseSpecification {
            /**
             * @inheritDoc
             */
            protected function getSpec()
            {
                return new NullFilter();
            }
        });
    }
}
