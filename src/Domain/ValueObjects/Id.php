<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class Id
{
    public function __construct(
        private readonly UuidInterface $id
    )
    {
    }

    public static function tryFrom(UuidInterface|string $uuid): static
    {
        if(is_string($uuid)) {
            $uuid = Uuid::fromString($uuid);
        }

        return new static($uuid);
    }

    public static function make(): static
    {
        return new static(Uuid::uuid4());
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}