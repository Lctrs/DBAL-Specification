<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Logic;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Exception\InvalidArgumentException;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;
use Lctrs\DBALSpecification\Specification;
use LogicException;
use function array_filter;
use function array_map;
use function implode;
use function in_array;
use function sprintf;

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
        if (! in_array($expression, [self::ANDX, self::ORX], true)) {
            throw new InvalidArgumentException(sprintf(
                '"%s" is not a valid logic expression. Valid expressions are: "%s"',
                $expression,
                implode(', ', [self::ANDX, self::ORX])
            ));
        }

        $this->expression = $expression;
        $this->children   = $children;
    }

    public function getFilter(QueryBuilder $queryBuilder, ?string $alias = null) : ?string
    {
        $exprBuilder = $queryBuilder->expr();
        $filters     = array_map(
            static function (Filter $filter) use ($queryBuilder, $alias) : ?string {
                return $filter->getFilter($queryBuilder, $alias);
            },
            array_filter(
                $this->children,
                static function ($spec) : bool {
                    return $spec instanceof Filter;
                }
            )
        );

        switch ($this->expression) {
            case self::ANDX:
                return (string) $exprBuilder->andX($filters);
            case self::ORX:
                return (string) $exprBuilder->orX($filters);
            default:
                throw new LogicException('Should not happen.');
        }
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
