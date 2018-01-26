<?php

namespace Lctrs\DBALSpecification\Exception;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
class UnsupportedQueryTypeException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct(sprintf('Only "SELECT" queries are supported.'));
    }
}
