<?php

namespace spec\Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\Offset;
use Lctrs\DBALSpecification\QueryModifier;
use PhpSpec\ObjectBehavior;

class OffsetSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(10);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Offset::class);
    }

    public function it_is_a_modifier()
    {
        $this->shouldBeAnInstanceOf(QueryModifier::class);
    }

    public function it_calls_offset(QueryBuilder $queryBuilder)
    {
        $queryBuilder->setFirstResult(10)->shouldBeCalled();

        $this->modify($queryBuilder, null);
    }
}
