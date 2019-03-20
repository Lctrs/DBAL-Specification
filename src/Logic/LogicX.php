<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Logic;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;
use Lctrs\DBALSpecification\Specification;
use function array_filter;
use function array_map;
use function call_user_func_array;

class LogicX implements Specification
{
    public const ANDX = 'andX';
    public const ORX  = 'orX';

    /** @var Filter[]|QueryModifier[] */
    private $children;
    /** @var string */
    private $expression;

    /**
     * @param Filter[]|QueryModifier[] $children
     */
    public function __construct(string $expression, array $children = [])
    {
        $this->expression = $expression;
        $this->children   = $children;
    }

    public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null) : ?string
    {
        return (string) call_user_func_array(
            [$queryBuilder->expr(), $this->expression],
            array_map(
                static function (Filter $filter) use ($queryBuilder, $alias) : ?string {
                    return $filter->getFilter($queryBuilder, $alias);
                },
                array_filter(
                    $this->children,
                    static function ($spec) : bool {
                        return $spec instanceof Filter;
                    }
                )
            )
        );
    }

    public function modify(QueryBuilder $queryBuilder, ?string $alias = null) : void
    {
        foreach ($this->children as $child) {
            if (! ($child instanceof QueryModifier)) {
                continue;
            }

            $child->modify($queryBuilder, $alias);
        }
    }

    /**
     * @param Filter|QueryModifier $child
     */
    protected function append($child) : void
    {
        $this->children[] = $child;
    }
}
