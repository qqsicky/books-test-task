<?php

namespace App\Domain\Service;

use App\Domain\Entity\Transaction\TransactionGroup;
use App\Domain\Entity\User\User;

class UserTransactionGroup
{
    private TransactionGroup $transactionGroup;

    public function __construct()
    {
        $this->transactionGroup = new TransactionGroup();
    }

    public function transferBalance(User $sender, User $receiver, int $amount): TransactionGroup
    {
        $balanceTransaction = new BalanceTransaction();

        $outTransaction = $balanceTransaction->decreaseBalance($sender->getBalance(), $amount);
        $this->transactionGroup->addTransaction($outTransaction);

        $inTransaction = $balanceTransaction->increaseBalance($receiver->getBalance(), $amount);
        $this->transactionGroup->addTransaction($inTransaction);

        return $this->transactionGroup;
    }
}