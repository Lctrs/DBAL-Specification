<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\ResultStatement;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Exception\UnsupportedQueryType;

abstract class SpecificationRepository
{
    /** @var Connection */
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function match(QueryModifier $specification): ResultStatement
    {
        $qb = $this->getQuery($specification);

        if ($qb->getType() !== QueryBuilder::SELECT) {
            throw new UnsupportedQueryType();
        }

        return $this->connection->executeQuery(
            $qb->getSQL(),
            $qb->getParameters(),
            $qb->getParameterTypes()
        );
    }

    private function getQuery(QueryModifier $specification): QueryBuilder
    {
        $qb = $this->connection->createQueryBuilder();
        $this->applySpecification($qb, $specification);

        return $qb;
    }

    private function applySpecification(
        QueryBuilder $queryBuilder,
        QueryModifier $specification
    ): void {
        $specification->modify($queryBuilder);

        if (! $specification instanceof Filter) {
            return;
        }

        $filter = $specification->getFilter($queryBuilder);

        if ($filter === null) {
            return;
        }

        $queryBuilder->andWhere($filter);
    }
}
