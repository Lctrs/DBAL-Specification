<?php

namespace spec\Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\From;
use Lctrs\DBALSpecification\QueryModifier;
use PhpSpec\ObjectBehavior;

class FromSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('foo', 'f');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(From::class);
    }

    public function it_is_a_modifier()
    {
        $this->shouldBeAnInstanceOf(QueryModifier::class);
    }

    public function it_calls_from(QueryBuilder $queryBuilder)
    {
        $queryBuilder->from('foo', 'f')->shouldBeCalled();

        $this->modify($queryBuilder, null);
    }

    public function it_uses_alias(QueryBuilder $queryBuilder)
    {
        $this->beConstructedWith('foo', null);

        $queryBuilder->from('foo', 'x')->shouldBeCalled();

        $this->modify($queryBuilder, 'x');
    }
}
