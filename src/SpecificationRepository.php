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

    /**
     * @param Filter|QueryModifier $specification
     */
    public function match($specification) : ResultStatement
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

    /**
     * @param Filter|QueryModifier $specification
     */
    private function getQuery($specification) : QueryBuilder
    {
        $qb = $this->connection->createQueryBuilder();
        $this->applySpecification($qb, $specification);

        return $qb;
    }

    /**
     * @param Filter|QueryModifier $specification
     */
    private function applySpecification(
        QueryBuilder $queryBuilder,
        $specification = null
    ) : void {
        if ($specification instanceof QueryModifier) {
            $specification->modify($queryBuilder);
        }

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
