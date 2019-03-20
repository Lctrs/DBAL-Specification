<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification\Logic;

use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\QueryModifier;

final class AndX extends LogicX
{
    /**
     * @param Filter[]|QueryModifier[] ...$children
     */
    public function __construct(...$children)
    {
        parent::__construct(self::ANDX, $children);
    }

    /**
     * @param Filter|QueryModifier $child
     */
    public function andX($child) : void
    {
        $this->append($child);
    }
}
