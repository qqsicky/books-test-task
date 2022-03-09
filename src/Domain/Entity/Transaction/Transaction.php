<?php

namespace App\Domain\Entity\Transaction;

use App\Domain\Entity\Traits\CreatedAtTrait;
use App\Domain\Entity\Traits\IdTrait;
use App\Domain\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Transaction
{
    use IdTrait;
    use CreatedAtTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Entity\User\User", inversedBy="transactions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="TransactionGroup", inversedBy="transactions")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    private ?TransactionGroup $group = null;

    /**
     * @ORM\Column(type="integer")
     */
    private int $amount;

    public function __construct(User $user, int $amount)
    {
        $this->identify();
        $this->onCreated();
        $this->user = $user;
        $this->amount = $amount;
    }

    public function setGroup(TransactionGroup $group): void
    {
        if (null === $this->group) {
            $this->group = $group;
            return;
        }

        throw new \DomainException("Cannot reassign transaction group");
    }
}