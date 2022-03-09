<?php

namespace App\Domain\Entity\User;

use App\Domain\Entity\Traits\CreatedAtTrait;
use App\Domain\Entity\Traits\IdTrait;
use App\Domain\Entity\Transaction\Transaction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    use IdTrait;
    use CreatedAtTrait;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Entity\Transaction\Transaction", mappedBy="id", cascade={"persist"})
     * @var Collection|Transaction[]
     */
    private Collection $transactions;

    /**
     * @ORM\OneToOne(targetEntity="Balance", mappedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="balance_id", referencedColumnName="id", nullable=false)
     */
    private Balance $balance;

    public function __construct()
    {
        $this->identify();
        $this->onCreated();
        $this->balance = new Balance($this);
        $this->transactions = new ArrayCollection();
    }

    public function getBalance(): Balance
    {
        return $this->balance;
    }

    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions->add($transaction);
    }
}