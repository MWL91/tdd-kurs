<?php

namespace Mwl91\Tdd\Infrastructure\Repositories\Fleet;

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;

interface FleetRepository
{
    public function count(): int;

    public function find(FleetId $id): ?Fleet;

    public function create(Fleet $fleet): void;
}
