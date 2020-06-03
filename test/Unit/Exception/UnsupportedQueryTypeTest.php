<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\Unit\Exception;

use Lctrs\DBALSpecification\Exception\UnsupportedQueryType;
use PHPUnit\Framework\TestCase;

final class UnsupportedQueryTypeTest extends TestCase
{
    public function testMessage(): void
    {
        self::assertSame(
            'Only "SELECT" queries are supported.',
            (new UnsupportedQueryType())->getMessage()
        );
    }
}
