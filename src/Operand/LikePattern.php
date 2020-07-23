<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Operand;

use Doctrine\DBAL\Query\QueryBuilder;

use function sprintf;

final class LikePattern
{
    public const CONTAINS    = '%%%s%%';
    public const ENDS_WITH   = '%%%s';
    public const STARTS_WITH = '%s%%';

    /** @var string */
    private $value;
    /** @var string */
    private $format;

    public function __construct(string $value, string $format = self::CONTAINS)
    {
        $this->value  = $value;
        $this->format = $format;
    }

    public function transform(QueryBuilder $queryBuilder): string
    {
        return $queryBuilder->createNamedParameter(
            sprintf($this->format, $this->value)
        );
    }
}
