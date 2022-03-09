<?php

namespace App\Domain\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * @todo: стоит изменить на ValueObject
 */
trait CreatedAtTrait
{
    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $createdAt;

    protected function onCreated(): void
    {
        $this->createdAt = new \DateTimeImmutable('now', new \DateTimeZone('utc'));
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}