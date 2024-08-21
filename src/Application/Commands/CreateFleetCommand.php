<?php

namespace Mwl91\Tdd\Application\Commands;

use Mwl91\Tdd\Domain\ValueObjects\FleetId;

class CreateFleetCommand
{

    public function __construct(
        private readonly FleetId $fleetId
    )
    {
    }

    public function getFleetId(): FleetId
    {
        return $this->fleetId;
    }
}
