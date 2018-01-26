<?php

namespace spec\Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Filter\IsNotNull;
use PhpSpec\ObjectBehavior;

class IsNotNullSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('foobar', 'a');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(IsNotNull::class);
    }

    public function it_is_a_filter()
    {
        $this->shouldBeAnInstanceOf(Filter::class);
    }

    public function it_calls_not_null(QueryBuilder $queryBuilder, ExpressionBuilder $expr)
    {
        $expression = 'a.foobar IS NOT NULL';

        $queryBuilder->expr()->willReturn($expr);
        $expr->isNotNull(sprintf('%s.%s', 'a', 'foobar'))->willReturn($expression);

        $this->getFilter($queryBuilder, null)->shouldReturn($expression);
    }

    public function it_uses_dql_alias_if_passed(QueryBuilder $queryBuilder, ExpressionBuilder $expr)
    {
        $alias = 'x';

        $this->beConstructedWith('foobar', null);

        $queryBuilder->expr()->willReturn($expr);
        $expr->isNotNull(sprintf('%s.%s', 'x', 'foobar'))->willReturn('x.foobar IS NOT NULL');

        $this->getFilter($queryBuilder, $alias)->shouldReturn('x.foobar IS NOT NULL');
    }
}
