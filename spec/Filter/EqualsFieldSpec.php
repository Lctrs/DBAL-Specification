<?php

namespace spec\Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Filter\EqualsField;
use PhpSpec\ObjectBehavior;

class EqualsFieldSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('l', 'foo', 'r', 'bar');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(EqualsField::class);
    }

    public function it_is_a_filter()
    {
        $this->shouldBeAnInstanceOf(Filter::class);
    }

    public function it_returns_comparison(QueryBuilder $queryBuilder, ExpressionBuilder $expressionBuilder)
    {
        $expressionBuilder->eq('l.foo', 'r.bar')->shouldBeCalled()->willReturn('l.foo = r.bar');
        $queryBuilder->expr()->willReturn($expressionBuilder);

        $this->getFilter($queryBuilder, null)->shouldReturn('l.foo = r.bar');
    }
}
