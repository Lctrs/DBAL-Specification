<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Filter;

use Lctrs\DBALSpecification\Filter\Comparison;
use Lctrs\DBALSpecification\Filter\Equals;
use Lctrs\DBALSpecification\Operand\Field;

final class EqualsTest extends ComparisonTest
{
    protected function getComparison(): Comparison
    {
        return new Equals(new Field('foo'), new Field('bar'));
    }

    protected function getExpected(): string
    {
        return 'foo = bar';
    }
}
