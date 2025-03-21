<?php

namespace Mwl91\Tdd\Application\Commands;

use Mwl91\Tdd\Domain\ValueObjects\FleetId;

abstract class FleetCommand
{

    public function __construct(
        private FleetId $fleetId
    )
    {
    }

    public function getFleetId(): FleetId
    {
        return $this->fleetId;
    }
}