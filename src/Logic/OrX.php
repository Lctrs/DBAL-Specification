<?php

namespace Lctrs\DBALSpecification\Logic;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class OrX extends LogicX
{
    public function __construct(...$children)
    {
        parent::__construct(self::ORX, $children);
    }

    public function orX($child)
    {
        $this->append($child);
    }
}
