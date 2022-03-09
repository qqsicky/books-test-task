<?php

namespace App\Tests\Functional\Domain\Service\UserTransactionGroup;

use App\Domain\Entity\User\User;
use App\Domain\Service\UserTransactionGroup;
use App\Tests\Functional\FunctionalTest;

class TransferBalanceTest extends FunctionalTest
{
    public function testSuccessful(): void
    {
        $sender = new User();

        $senderBalanceAmount = random_int(1, 10_000_000);
        $sender->getBalance()->increase($senderBalanceAmount);

        $receiver = new User();

        $userTransactionGroup = new UserTransactionGroup();
        $transferAmount = random_int(1, $senderBalanceAmount);

        $transferGroup = $userTransactionGroup->transferBalance($sender, $receiver, $transferAmount);

        $this->assertEquals($senderBalanceAmount - $transferAmount, $sender->getBalance()->getAmount());
        $this->assertEquals($transferAmount, $receiver->getBalance()->getAmount());
        $this->assertCount(2, $transferGroup->getTransactions());
    }

    public function testAmountNonPositive(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Amount must be more than 0');

        $sender = new User();
        $receiver = new User();

        $userTransactionGroup = new UserTransactionGroup();

        $userTransactionGroup->transferBalance($sender, $receiver, -1);
    }

    public function testBalanceUnderTransferAmount(): void
    {

        $sender = new User();

        $senderBalanceAmount = random_int(1, 10_000_000);
        $transferAmount = $senderBalanceAmount + 1;
        $sender->getBalance()->increase($senderBalanceAmount);

        $receiver = new User();

        $userTransactionGroup = new UserTransactionGroup();

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Cannot decrease {$transferAmount} from user {$sender->getId()} cause of balance: {$senderBalanceAmount}");

        $userTransactionGroup->transferBalance($sender, $receiver, $senderBalanceAmount + 1);
    }
}