<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Domain\ValueObjects;

use Money\Money;

final class PickupPolicy
{
    private readonly Money $officePickupCost;
    private readonly Money $airportPickupCost;
    private readonly Money $addressPickupCost;
    private readonly Money $overtimePickupCost;

    public function __construct(
        Money $officePickupCost,
        Money $airportPickupCost,
        Money $addressPickupCost,
        Money $overtimePickupCost,
    )
    {
        if(
            $officePickupCost->isNegative() ||
            $airportPickupCost->isNegative() ||
            $addressPickupCost->isNegative() ||
            $overtimePickupCost->isNegative()
        ) {
            throw new \OutOfBoundsException("Delivery cost must be positive");
        }

        $this->officePickupCost = $officePickupCost;
        $this->airportPickupCost = $airportPickupCost;
        $this->addressPickupCost = $addressPickupCost;
        $this->overtimePickupCost = $overtimePickupCost;
    }

    public function getOfficePickupCost(): Money
    {
        return $this->officePickupCost;
    }

    public function getAirportPickupCost(): Money
    {
        return $this->airportPickupCost;
    }

    public function getAddressPickupCost(): Money
    {
        return $this->addressPickupCost;
    }

    public function getOvertimePickupCost(): Money
    {
        return $this->overtimePickupCost;
    }
}