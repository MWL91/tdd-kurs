<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Domain\Fleet;

use Money\Currency;
use Money\Money;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\PickupPolicy;
use Mwl91\Tests\Tdd\FleetTestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DeliveryCostTest extends FleetTestCase
{

    public function testCanSetDeliveryCost(): void
    {
        // Given:
        $fleet = new Fleet();
        $pickupPolicy = new PickupPolicy(
            $officePickupCost = new Money($this->faker->numberBetween(10, 50), new Currency("PLN")),
            $airportPickupCost = new Money($this->faker->numberBetween(10, 50), new Currency("PLN")),
            $addressPickupCost = new Money($this->faker->numberBetween(10, 50), new Currency("PLN")),
            $overtimePickupCost = new Money($this->faker->numberBetween(10, 50), new Currency("PLN")),
        );

        // When:
        $fleet->setPickupPolicy($pickupPolicy);

        // Then:
        $this->assertEquals($officePickupCost, $fleet->getOfficePickupCost());
        $this->assertEquals($airportPickupCost, $fleet->getAirportPickupCost());
        $this->assertEquals($addressPickupCost, $fleet->getAddressPickupCost());
        $this->assertEquals($overtimePickupCost, $fleet->getOvertimePickupCost());
    }


}
