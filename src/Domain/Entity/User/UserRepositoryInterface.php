<?php

namespace App\Domain\Entity\User;

use Ramsey\Uuid\UuidInterface;

interface UserRepositoryInterface
{
    public function find(UuidInterface $id): User;
}