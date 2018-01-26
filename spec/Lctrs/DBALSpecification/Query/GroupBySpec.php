<?php

namespace spec\Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\GroupBy;
use Lctrs\DBALSpecification\QueryModifier;
use PhpSpec\ObjectBehavior;

class GroupBySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('foo', 'f');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GroupBy::class);
    }

    public function it_is_a_modifier()
    {
        $this->shouldBeAnInstanceOf(QueryModifier::class);
    }

    public function it_calls_groupby(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addGroupBy('f.foo')->shouldBeCalled();

        $this->modify($queryBuilder, null);
    }

    public function it_uses_alias(QueryBuilder $queryBuilder)
    {
        $this->beConstructedWith('foo', null);

        $queryBuilder->addGroupBy('x.foo')->shouldBeCalled();

        $this->modify($queryBuilder, 'x');
    }
}
