<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\Select;
use PHPUnit\Framework\TestCase;

class SelectTest extends TestCase
{
    public function testItCallsSelect() : void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->expects(self::once())
            ->method('addSelect')
            ->with('f.foo');

        (new Select('foo', 'f'))->modify($queryBuilder);
    }

    public function testItUsesAlias() : void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->expects(self::once())
            ->method('addSelect')
            ->with('x.foo');

        (new Select('foo'))->modify($queryBuilder, 'x');
    }
}
