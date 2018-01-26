<?php

namespace Lctrs\DBALSpecification\Logic;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;
use Lctrs\DBALSpecification\Specification;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
class LogicX implements Specification
{
    public const ANDX = 'andX';
    public const ORX = 'orX';

    /**
     * @var Filter[]|QueryModifier[]
     */
    private $children;
    private $expression;

    public function __construct(string $expression, array $children = [])
    {
        $this->expression = $expression;
        $this->children = $children;
    }

    public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null): ?string
    {
        return (string) \call_user_func_array(
            [$queryBuilder->expr(), $this->expression],
            array_map(
                function ($spec) use ($queryBuilder, $alias) {
                    if (!$spec instanceof Filter) {
                        return;
                    }

                    return $spec->getFilter($queryBuilder, $alias);
                },
                $this->children
            )
        );
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null): void
    {
        foreach ($this->children as $child) {
            if ($child instanceof QueryModifier) {
                $child->modify($queryBuilder, $alias);
            }
        }
    }

    protected function append($child)
    {
        $this->children[] = $child;
    }
}
