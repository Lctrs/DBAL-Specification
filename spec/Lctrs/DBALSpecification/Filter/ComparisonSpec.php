<?php

namespace spec\Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Exception\InvalidArgumentException;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Filter\Comparison;
use PhpSpec\ObjectBehavior;

class ComparisonSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(Comparison::GT, 'age', 18, 'a');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Comparison::class);
    }

    public function it_is_a_filter()
    {
        $this->shouldBeAnInstanceOf(Filter::class);
    }

    public function it_returns_comparison(QueryBuilder $queryBuilder)
    {
        $queryBuilder->createNamedParameter(18)->shouldBeCalled()->willReturn(':dcValue1');

        $this->getFilter($queryBuilder, null)->shouldReturn('a.age > :dcValue1');
    }

    public function it_uses_alias_if_passed(QueryBuilder $queryBuilder)
    {
        $this->beConstructedWith(Comparison::GT, 'age', 18, null);

        $queryBuilder->createNamedParameter(18)->shouldBeCalled()->willReturn(':dcValue1');

        $this->getFilter($queryBuilder, 'x')->shouldReturn('x.age > :dcValue1');
    }

    public function it_validated_operator()
    {
        $this->shouldThrow(InvalidArgumentException::class)->during('__construct', [
            'not valid operator',
            'age',
            18,
            null,
        ]);
    }
}
