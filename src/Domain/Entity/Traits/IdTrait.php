<?php

namespace App\Domain\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @todo: стоит изменить на ValueObject
 */
trait IdTrait
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     */
    private UuidInterface $id;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    protected function identify(): void
    {
        $this->id = Uuid::uuid4();
    }
}