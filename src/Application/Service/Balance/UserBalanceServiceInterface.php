<?php

namespace App\Application\Service\Balance;

use App\Domain\Entity\User\User;

interface UserBalanceServiceInterface
{
    public function transferBalance(User $sender, User $receiver, int $amount);
}