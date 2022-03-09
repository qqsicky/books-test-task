<?php

namespace App\Domain\Service;

use App\Domain\Entity\Transaction\Transaction;
use App\Domain\Entity\User\Balance;

class BalanceTransaction
{
    public function increaseBalance(Balance $balance, int $amount): Transaction
    {
        $balance->increase($amount);

        return new Transaction($balance->getUser(), $amount);
    }

    public function decreaseBalance(Balance $balance, int $amount): Transaction
    {
        $balance->decrease($amount);

        return new Transaction($balance->getUser(), -$amount);
    }
}