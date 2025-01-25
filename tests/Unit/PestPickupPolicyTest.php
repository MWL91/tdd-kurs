<?php

use Money\Currency;
use Money\Money;
use Mwl91\Tdd\Domain\ValueObjects\PickupPolicy;

it('cannot create negative pickup policy costs', function (
    Money $officePickupCost,
    Money $airportPickupCost,
    Money $addressPickupCost,
    Money $overtimePickupCost,
) {
    // When:
    $pickupPolicy = new PickupPolicy(
        officePickupCost: $officePickupCost,
        airportPickupCost: $airportPickupCost,
        addressPickupCost: $addressPickupCost,
        overtimePickupCost: $overtimePickupCost,
    );

    // Then:
    expect($pickupPolicy)->toBeInstanceOf(PickupPolicy::class)
        ->and($pickupPolicy->getOfficePickupCost())->toEqual($officePickupCost)
        ->and($pickupPolicy->getAddressPickupCost())->toEqual($addressPickupCost)
        ->and($pickupPolicy->getOvertimePickupCost())->toEqual($overtimePickupCost)
        ->and($pickupPolicy->getAirportPickupCost())->toEqual($airportPickupCost);
})->with([
    'invalidOfficePickup' => [
        new Money(-50, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
    ],
    'invalidAirportPickupCost' => [
        new Money(20, new Currency("PLN")),
        new Money(-10, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
    ],
    'invalidAddressPickupCost' => [
        new Money(50, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
        new Money(-30, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
    ],
    'invalidOvertimePickupCost' => [
        new Money(10, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
        new Money(10, new Currency("PLN")),
        new Money(-40, new Currency("PLN")),
    ],
])
->throws(\OutOfBoundsException::class);