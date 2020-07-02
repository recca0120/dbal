<?php

declare(strict_types=1);

namespace Doctrine\DBAL;

use Doctrine\DBAL\Abstraction\Result as ResultInterface;
use Doctrine\DBAL\Driver\Exception as DriverException;
use Doctrine\DBAL\Driver\Result as DriverResult;
use Traversable;

final class Result implements ResultInterface
{
    /** @var DriverResult */
    private $result;

    /** @var Connection */
    private $connection;

    public function __construct(DriverResult $result, Connection $connection)
    {
        $this->result     = $result;
        $this->connection = $connection;
    }

    /**
     * {@inheritDoc}
     *
     * @throws DBALException
     */
    public function fetchNumeric()
    {
        try {
            return $this->result->fetchNumeric();
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @throws DBALException
     */
    public function fetchAssociative()
    {
        try {
            return $this->result->fetchAssociative();
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @throws DBALException
     */
    public function fetchOne()
    {
        try {
            return $this->result->fetchOne();
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @throws DBALException
     */
    public function fetchAllNumeric(): array
    {
        try {
            return $this->result->fetchAllNumeric();
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @throws DBALException
     */
    public function fetchAllAssociative(): array
    {
        try {
            return $this->result->fetchAllAssociative();
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @throws DBALException
     */
    public function fetchFirstColumn(): array
    {
        try {
            return $this->result->fetchFirstColumn();
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    /**
     * @return Traversable<int,array<int,mixed>>
     *
     * @throws DBALException
     */
    public function iterateNumeric(): Traversable
    {
        try {
            while (($row = $this->result->fetchNumeric()) !== false) {
                yield $row;
            }
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    /**
     * @return Traversable<int,array<string,mixed>>
     *
     * @throws DBALException
     */
    public function iterateAssociative(): Traversable
    {
        try {
            while (($row = $this->result->fetchAssociative()) !== false) {
                yield $row;
            }
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    /**
     * @return Traversable<int,mixed>
     *
     * @throws DBALException
     */
    public function iterateColumn(): Traversable
    {
        try {
            while (($value = $this->result->fetchOne()) !== false) {
                yield $value;
            }
        } catch (DriverException $e) {
            $this->connection->handleDriverException($e);
        }
    }

    public function rowCount(): int
    {
        return $this->result->rowCount();
    }

    public function columnCount(): int
    {
        return $this->result->columnCount();
    }

    public function free(): void
    {
        $this->result->free();
    }
}
