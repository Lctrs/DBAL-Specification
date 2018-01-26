<?php

namespace Lctrs\DBALSpecification\Filter;

final class Like extends Comparison
{
    public const CONTAINS = '%%%s%%';
    public const ENDS_WITH = '%%%s';
    public const STARTS_WITH = '%s%%';

    public function __construct(string $field, string $value, string $format = self::CONTAINS, ?string $alias = null)
    {
        $formattedValue = $this->formatValue($format, $value);
        parent::__construct(self::LIKE, $field, $formattedValue, $alias);
    }

    private function formatValue(string $format, string $value): string
    {
        return sprintf($format, $value);
    }
}
