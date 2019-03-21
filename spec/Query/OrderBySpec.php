<?php

namespace spec\Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\OrderBy;
use Lctrs\DBALSpecification\QueryModifier;
use PhpSpec\ObjectBehavior;

class OrderBySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('foo', 'ASC', 'f');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(OrderBy::class);
    }

    public function it_is_a_modifier()
    {
        $this->shouldBeAnInstanceOf(QueryModifier::class);
    }

    public function it_calls_orderby(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addOrderBy('f.foo', 'ASC')->shouldBeCalled();

        $this->modify($queryBuilder, null);
    }

    public function it_uses_alias(QueryBuilder $queryBuilder)
    {
        $this->beConstructedWith('foo', 'ASC', null);

        $queryBuilder->addOrderBy('x.foo', 'ASC')->shouldBeCalled();

        $this->modify($queryBuilder, 'x');
    }
}
