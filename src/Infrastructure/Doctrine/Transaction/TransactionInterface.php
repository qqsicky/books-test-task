<?php

namespace App\Infrastructure\Doctrine\Transaction;

interface TransactionInterface
{
    public function transactional(callable $scope);
    public function persist(...$entities): void;
}
