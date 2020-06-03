<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Operand;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Operand\LikePattern;
use PHPUnit\Framework\TestCase;

class LikePatternTest extends TestCase
{
    /**
     * @dataProvider getFormats
     */
    public function testItFormats(string $value, string $expected, string $format): void
    {
        $queryBuilder = new QueryBuilder($this->createMock(Connection::class));

        self::assertSame(
            ':dcValue1',
            (new LikePattern($value, $format))->transform($queryBuilder)
        );
        self::assertSame($expected, $queryBuilder->getParameter('dcValue1'));
    }

    /**
     * @return iterable<int, array<int, string>>
     */
    public function getFormats(): iterable
    {
        yield [
            'dummy',
            '%dummy%',
            LikePattern::CONTAINS,
        ];

        yield [
            'dummy',
            '%dummy',
            LikePattern::ENDS_WITH,
        ];

        yield [
            'dummy',
            'dummy%',
            LikePattern::STARTS_WITH,
        ];
    }
}
