<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Infrastructure\Repositories\Fleet;

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;

final class FleetInMemoryRepository implements FleetRepository
{
    public function __construct(
        private array $fleets = []
    )
    {
    }

    public function count(): int
    {
        return count($this->fleets);
    }

    public function find(FleetId $id): ?Fleet
    {
        $found = array_filter($this->fleets, fn(Fleet $fleet) => $fleet->getKey() === $id);
        return end($found);
    }

    public function create(Fleet $fleet): void
    {
        $this->fleets[] = $fleet;
    }
}
