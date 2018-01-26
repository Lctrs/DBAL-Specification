<?php

namespace Lctrs\DBALSpecification\Filter;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class NotEquals extends Comparison
{
    public function __construct(string $field, string $value, ?string $alias = null)
    {
        parent::__construct(self::NEQ, $field, $value, $alias);
    }
}
