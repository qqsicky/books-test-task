<?php

namespace App\Domain\Entity\User;

use App\Domain\Entity\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Balance
{
    use IdTrait;

    /**
     * @ORM\Column(type="integer")
     */
    private int $balance = 0;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="balance", orphanRemoval="true")
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->identify();
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAmount(): int
    {
        return $this->balance;
    }

    public function increase(int $amount): void
    {
        $this->validateAmount($amount);

        $this->balance += $amount;
    }

    public function decrease(int $amount): void
    {
        $this->validateAmount($amount);

        if ($this->balance - $amount < 0) {
            throw new \DomainException(
                "Cannot decrease {$amount} from user {$this->getUser()->getId()} cause of balance: {$this->balance}"
            );
        }

        $this->balance -= $amount;
    }

    private function validateAmount(int $amount): void
    {
        if ($amount <= 0) {
            throw new \DomainException("Amount must be more than 0");
        }
    }
}