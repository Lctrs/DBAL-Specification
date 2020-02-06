<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Test\AutoReview;

use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class SrcCodeTest extends TestCase
{
    use Helper;

    public function testSrcClassesHaveUnitTests() : void
    {
        self::assertClassesHaveTests(
            __DIR__ . '/../../src',
            'Lctrs\\DBALSpecification\\',
            'Lctrs\\DBALSpecification\\Test\\Unit\\'
        );
    }
}
