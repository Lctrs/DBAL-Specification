<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Filter;

use Lctrs\DBALSpecification\Filter\Comparison;
use Lctrs\DBALSpecification\Filter\GreaterThanOrEqual;
use Lctrs\DBALSpecification\Operand\Field;

final class GreaterThanOrEqualTest extends ComparisonTest
{
    protected function getComparison(): Comparison
    {
        return new GreaterThanOrEqual(new Field('foo'), new Field('bar'));
    }

    protected function getExpected(): string
    {
        return 'foo >= bar';
    }
}
