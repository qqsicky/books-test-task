<?php

namespace App\Infrastructure\Repository\Doctrine;

use Doctrine\ORM\EntityManager;

abstract class BaseDoctrineRepository
{
    protected EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
