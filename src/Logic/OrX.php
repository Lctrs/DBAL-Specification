<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Logic;

use Doctrine\DBAL\Query\Expression\ExpressionBuilder;

final class OrX extends LogicX
{
    /**
     * @inheritDoc
     */
    protected function doGetFilters(ExpressionBuilder $expressionBuilder, array $filters): ?string
    {
        return (string) $expressionBuilder->orX(...$filters);
    }
}
