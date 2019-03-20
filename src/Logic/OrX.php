<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Logic;

use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;

final class OrX extends LogicX
{
    /**
     * @param Filter[]|QueryModifier[] ...$children
     */
    public function __construct(...$children)
    {
        parent::__construct(self::ORX, $children);
    }

    /**
     * @param Filter|QueryModifier $child
     */
    public function orX($child) : void
    {
        $this->append($child);
    }
}
