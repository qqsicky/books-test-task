<?php

namespace App\Domain\Entity\Transaction;

use App\Domain\Entity\Traits\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TransactionGroup
{
    use IdTrait;

    /**
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="id", cascade={"all"})
     * @var Collection|Transaction[]
     */
    private Collection $transactions;

    public function __construct()
    {
        $this->identify();
        $this->transactions = new ArrayCollection();
    }

    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions->add($transaction);
        $transaction->setGroup($this);
    }
}