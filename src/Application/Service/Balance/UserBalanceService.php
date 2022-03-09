<?php

namespace App\Application\Service\Balance;

use App\Domain\Entity\User\User;
use App\Domain\Service\UserTransactionGroup;
use App\Infrastructure\Doctrine\Transaction\TransactionInterface;

class UserBalanceService implements UserBalanceServiceInterface
{
    private TransactionInterface $doctrineTransaction;

    public function __construct(TransactionInterface $doctrineTransaction)
    {
        $this->doctrineTransaction = $doctrineTransaction;
    }

    public function transferBalance(User $sender, User $receiver, int $amount): void
    {
        $this->doctrineTransaction->transactional(function () use ($sender, $receiver, $amount) {
            $userTransactionGroup = new UserTransactionGroup();
            $transactionGroup = $userTransactionGroup->transferBalance($sender, $receiver, $amount);

            $this->doctrineTransaction->persist($sender, $receiver, $transactionGroup);
        });
    }
}