<?php

namespace spec\Lctrs\DBALSpecification\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Query\Limit;
use Lctrs\DBALSpecification\QueryModifier;
use PhpSpec\ObjectBehavior;

class LimitSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(10);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Limit::class);
    }

    public function it_is_a_modifier()
    {
        $this->shouldBeAnInstanceOf(QueryModifier::class);
    }

    public function it_calls_limit(QueryBuilder $queryBuilder)
    {
        $queryBuilder->setMaxResults(10)->shouldBeCalled();

        $this->modify($queryBuilder, null);
    }
}
