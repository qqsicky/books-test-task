<?php

namespace App\Infrastructure\Repository\Doctrine\User;

use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepositoryInterface;
use App\Infrastructure\Repository\Doctrine\BaseDoctrineRepository;
use Doctrine\ORM\EntityNotFoundException;
use Ramsey\Uuid\UuidInterface;

class UserRepository extends BaseDoctrineRepository implements UserRepositoryInterface
{
    public function find(UuidInterface $id): User
    {
        $user = $this->entityManager->find(User::class, $id);

        if (null !== $user) {
            return $user;
        }

        throw new EntityNotFoundException("User with id {$id} was not found");
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
    }
}