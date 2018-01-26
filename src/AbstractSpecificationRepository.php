<?php

namespace Lctrs\DBALSpecification;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\Query\QueryBuilder;
use Lctrs\DBALSpecification\Exception\UnsupportedQueryTypeException;

/**
 * @author Jérôme Parmentier <jerome@prmntr.me>
 */
abstract class AbstractSpecificationRepository
{
    protected $connection;
    protected $alias;

    public function __construct(Connection $connection, ?string $alias = null)
    {
        $this->connection = $connection;
        $this->alias = $alias;
    }

    public function match($specification): Statement
    {
        $qb = $this->getQuery($specification);

        if (QueryBuilder::SELECT !== $qb->getType()) {
            throw new UnsupportedQueryTypeException();
        }

        return $qb->execute();
    }

    protected function getQuery($specification): QueryBuilder
    {
        $qb = $this->connection->createQueryBuilder();
        $this->applySpecification($qb, $specification, $this->alias);

        return $qb;
    }

    protected function applySpecification(QueryBuilder $queryBuilder, $specification = null, ?string $alias = null): void
    {
        if (null === $specification) {
            return;
        }

        if (!$specification instanceof QueryModifier && !$specification instanceof Filter) {
            throw new \InvalidArgumentException(sprintf(
                'Expected argument of type "%s" or "%s", "%s" given.',
                QueryModifier::class,
                Filter::class,
                is_object($specification) ? get_class($specification) : gettype($specification)
            ));
        }

        if ($specification instanceof QueryModifier) {
            $specification->modify($queryBuilder, $alias);
        }

        if ($specification instanceof Filter && $filter = $specification->getFilter($queryBuilder, $alias)) {
            $queryBuilder->andWhere($filter);
        }
    }
}
