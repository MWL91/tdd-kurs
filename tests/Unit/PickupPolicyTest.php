<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit;

use http\Exception\InvalidArgumentException;
use Money\Currency;
use Money\Money;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\PickupPolicy;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PickupPolicyTest extends TestCase
{
    private readonly \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
    }

    public function testCanCreatePickupPolicy(): void
    {
        // Given:
        $officePickupCost = new Money($this->faker->numberBetween(10, 50), new Currency("PLN"));
        $airportPickupCost = new Money($this->faker->numberBetween(10, 50), new Currency("PLN"));
        $addressPickupCost = new Money($this->faker->numberBetween(10, 50), new Currency("PLN"));
        $overtimePickupCost = new Money($this->faker->numberBetween(10, 50), new Currency("PLN"));

        // When:
        $pickupPolicy = new PickupPolicy(
            officePickupCost: $officePickupCost,
            airportPickupCost: $airportPickupCost,
            addressPickupCost: $addressPickupCost,
            overtimePickupCost: $overtimePickupCost,
        );

        // Then:
        $this->assertInstanceOf(PickupPolicy::class, $pickupPolicy);
        $this->assertEquals($officePickupCost, $pickupPolicy->getOfficePickupCost());
        $this->assertEquals($airportPickupCost, $pickupPolicy->getAirportPickupCost());
        $this->assertEquals($addressPickupCost, $pickupPolicy->getAddressPickupCost());
        $this->assertEquals($overtimePickupCost, $pickupPolicy->getOvertimePickupCost());
    }

    public static function invalidDeliveryCostDataProvider(): array
    {
        return [
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
        ];
    }

    #[DataProvider('invalidDeliveryCostDataProvider')]
    public function testCannotCreateNegativePickupPolicyCosts(
        Money $officePickupCost,
        Money $airportPickupCost,
        Money $addressPickupCost,
        Money $overtimePickupCost,
    ): void
    {
        // Given:
        $this->expectException(\OutOfBoundsException::class);

        // When:
        $pickupPolicy = new PickupPolicy(
            officePickupCost: $officePickupCost,
            airportPickupCost: $airportPickupCost,
            addressPickupCost: $addressPickupCost,
            overtimePickupCost: $overtimePickupCost,
        );

        // Then:
        $this->assertInstanceOf(PickupPolicy::class, $pickupPolicy);
        $this->assertEquals($officePickupCost, $pickupPolicy->getOfficePickupCost());
        $this->assertEquals($airportPickupCost, $pickupPolicy->getAirportPickupCost());
        $this->assertEquals($addressPickupCost, $pickupPolicy->getAddressPickupCost());
        $this->assertEquals($overtimePickupCost, $pickupPolicy->getOvertimePickupCost());
    }
}