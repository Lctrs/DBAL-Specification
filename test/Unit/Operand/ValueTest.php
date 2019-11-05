<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Operand;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Types\Types;
use Lctrs\DBALSpecification\Operand\Value;
use PHPUnit\Framework\TestCase;

final class ValueTest extends TestCase
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    protected function setUp() : void
    {
        $this->queryBuilder = new QueryBuilder($this->createMock(Connection::class));
    }

    /**
     * @param mixed $type
     *
     * @dataProvider getTypes
     */
    public function testItCreatesAParameter($type) : void
    {
        self::assertSame(
            ':dcValue1',
            (new Value('dummy', $type))->transform($this->queryBuilder)
        );
        self::assertSame('dummy', $this->queryBuilder->getParameter('dcValue1'));
        self::assertSame($type, $this->queryBuilder->getParameterType('dcValue1'));
    }

    /**
     * @return iterable|mixed[]
     */
    public function getTypes() : iterable
    {
        yield [null];
        yield [ParameterType::INTEGER];
        yield [Types::DECIMAL];
        yield [Connection::PARAM_INT_ARRAY];
        yield [Connection::PARAM_STR_ARRAY];
    }
}
