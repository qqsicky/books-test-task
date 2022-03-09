<?php

namespace App\Infrastructure\Doctrine\Transaction;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Throwable;

class DoctrineTransaction implements TransactionInterface
{
    private EntityManager $manager;
    private Connection $connection;
    private string $env;

    public function __construct(EntityManager $manager, string $env)
    {
        $this->manager = $manager;
        $this->connection = $manager->getConnection();
        $this->env = $env;
    }

    public function transactional(callable $scope)
    {
        $this->connection->beginTransaction();

        try {
            $returned = $scope();

            $this->manager->flush();
            $this->connection->commit();

            return $returned;
        } catch (Throwable $e) {
            $this->forceStop();
            throw $e;
        }
    }

    public function persist(...$entities): void
    {
        try {
            foreach ($entities as $entity) {
                $this->manager->persist($entity);
            }
        } catch (Throwable $e) {
            $this->forceStop();
            throw $e;
        }
    }

    private function closeManager(): void
    {
        if ('test' !== $this->env) {
            $this->manager->close();
        }
    }

    private function forceStop(): void
    {
        $this->closeManager();

        $this->connection->rollBack();
    }
}
