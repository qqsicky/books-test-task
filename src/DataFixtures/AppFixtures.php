<?php

namespace App\DataFixtures;

use App\Domain\Entity\Transaction\Transaction;
use App\Domain\Entity\User\User;
use App\Domain\Service\BalanceTransaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $userOne = $this->createUser($manager);

        $this->createTransaction($manager, $userOne);

        $this->createUser($manager);

        $manager->flush();
    }

    private function createUser(ObjectManager $manager): User
    {
        $user = new User();
        $manager->persist($user->getBalance());
        $manager->persist($user);

        return $user;
    }

    private function createTransaction(ObjectManager $manager, User $user): Transaction
    {
        $balanceTransaction = new BalanceTransaction();
        $transaction = $balanceTransaction->increaseBalance($user->getBalance(), 100);
        $manager->persist($transaction);

        return $transaction;
    }
}
