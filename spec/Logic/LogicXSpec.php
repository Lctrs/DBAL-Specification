<?php

namespace spec\Lctrs\DBALSpecification\Logic;

use Doctrine\Common\Collections\ExpressionBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter;
use Lctrs\DBALSpecification\Logic\LogicX;
use Lctrs\DBALSpecification\Specification;
use PhpSpec\ObjectBehavior;

class LogicXSpec extends ObjectBehavior
{
    private const EXPRESSION = 'andX';

    public function let(Specification $specificationA, Specification $specificationB)
    {
        $this->beConstructedWith(self::EXPRESSION, [$specificationA, $specificationB]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(LogicX::class);
    }

    public function it_is_a_specification()
    {
        $this->shouldBeAnInstanceOf(Specification::class);
    }

    public function it_modifies_all_child_queries(QueryBuilder $queryBuilder, Specification $specificationA, Specification $specificationB)
    {
        $alias = 'a';

        $specificationA->modify($queryBuilder, $alias)->shouldBeCalled();
        $specificationB->modify($queryBuilder, $alias)->shouldBeCalled();

        $this->modify($queryBuilder, $alias);
    }

    public function it_composes_and_child_with_expression(QueryBuilder $qb, ExpressionBuilder $expression, Specification $specificationA, Specification $specificationB)
    {
        $alias = 'a';
        $x = 'expr1';
        $y = 'expr2';

        $specificationA->getFilter($qb, $alias)->willReturn($x);
        $specificationB->getFilter($qb, $alias)->willReturn($y);
        $qb->expr()->willReturn($expression);

        $expression->{self::EXPRESSION}([$x, $y])->shouldBeCalled();

        $this->getFilter($qb, $alias);
    }

    public function it_supports_expressions(QueryBuilder $qb, ExpressionBuilder $expression, Filter $exprA, Filter $exprB)
    {
        $this->beConstructedWith(self::EXPRESSION, [$exprA, $exprB]);

        $alias = 'a';
        $x = 'expr1';
        $y = 'expr2';

        $exprA->getFilter($qb, $alias)->willReturn($x);
        $exprB->getFilter($qb, $alias)->willReturn($y);
        $qb->expr()->willReturn($expression);

        $expression->{self::EXPRESSION}([$x, $y])->shouldBeCalled();

        $this->getFilter($qb, $alias);
    }
}
