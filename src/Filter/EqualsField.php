<?php

namespace Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class EqualsField implements Filter
{
    private $leftAlias;
    private $leftField;
    private $rightAlias;
    private $rightField;

    public function __construct(string $leftAlias, string $leftField, string $rightAlias, string $rightField)
    {
        $this->leftAlias = $leftAlias;
        $this->leftField = $leftField;
        $this->rightAlias = $rightAlias;
        $this->rightField = $rightField;
    }

    public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null): ?string
    {
        return $queryBuilder->expr()->eq(
            sprintf('%s.%s', $this->leftAlias, $this->leftField),
            sprintf('%s.%s', $this->rightAlias, $this->rightField)
        );
    }
}
