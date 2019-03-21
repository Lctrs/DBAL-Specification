<?php

declare(strict_types=1);

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Exception\UnsupportedQueryTypeException;

abstract class AbstractSpecificationRepository
{
    /** @var Connection */
    protected $connection;
    /** @var string|null */
    protected $alias;

    public function __construct(Connection $connection, ?string $alias = null)
    {
        $this->connection = $connection;
        $this->alias      = $alias;
    }

    /**
     * @param Filter|QueryModifier $specification
     */
    public function match($specification) : Statement
    {
        $qb = $this->getQuery($specification);

        if ($qb->getType() !== QueryBuilder::SELECT) {
            throw new UnsupportedQueryTypeException();
        }

        return $qb->execute();
    }

    /**
     * @param Filter|QueryModifier $specification
     */
    protected function getQuery($specification) : QueryBuilder
    {
        $qb = $this->connection->createQueryBuilder();
        $this->applySpecification($qb, $specification, $this->alias);

        return $qb;
    }

    /**
     * @param Filter|QueryModifier|null $specification
     */
    protected function applySpecification(
        QueryBuilder $queryBuilder,
        $specification = null,
        ?string $alias = null
    ) : void {
        if ($specification === null) {
            return;
        }

        if ($specification instanceof QueryModifier) {
            $specification->modify($queryBuilder, $alias);
        }

        $filter = $specification->getFilter($queryBuilder, $alias);
        if (! ($specification instanceof Filter) || ! $filter) {
            return;
        }

        $queryBuilder->andWhere($filter);
    }
}
