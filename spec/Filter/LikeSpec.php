<?php

namespace spec\Lctrs\DBALSpecification\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Filter\Like;
use PhpSpec\ObjectBehavior;

class LikeSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('foo', 'bar', Like::CONTAINS, 'alias');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Like::class);
    }

    public function it_surrounds_with_wildcards_when_using_contains(QueryBuilder $queryBuilder)
    {
        $this->beConstructedWith('foo', 'bar', Like::CONTAINS, 'alias');

        $queryBuilder->createNamedParameter('%bar%')->shouldBeCalled();

        $this->getFilter($queryBuilder, null);
    }

    public function it_starts_with_wildcard_when_using_ends_with(QueryBuilder $queryBuilder)
    {
        $this->beConstructedWith('foo', 'bar', Like::ENDS_WITH, 'alias');

        $queryBuilder->createNamedParameter('%bar')->shouldBeCalled();

        $this->getFilter($queryBuilder, null);
    }

    public function it_ends_with_wildcard_when_using_starts_with(QueryBuilder $queryBuilder)
    {
        $this->beConstructedWith('foo', 'bar', Like::STARTS_WITH, 'alias');

        $queryBuilder->createNamedParameter('bar%')->shouldBeCalled();

        $this->getFilter($queryBuilder, null);
    }
}
