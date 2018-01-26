<?php

namespace Lctrs\DBALSpecification\Logic;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
final class AndX extends LogicX
{
    public function __construct(...$children)
    {
        parent::__construct(self::ANDX, $children);
    }

    public function andX($child)
    {
        $this->append($child);
    }
}
