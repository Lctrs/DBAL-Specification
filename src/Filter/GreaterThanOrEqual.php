<?php

namespace Lctrs\DBALSpecification\Filter;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class GreaterThanOrEqual extends Comparison
{
    public function __construct(string $field, string $value, ?string $alias = null)
    {
        parent::__construct(self::GTE, $field, $value, $alias);
    }
}
