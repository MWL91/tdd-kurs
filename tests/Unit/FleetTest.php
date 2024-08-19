<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit;

use Money\Currency;
use Money\Money;
use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;
use Mwl91\Tdd\Domain\ValueObjects\PickupPolicy;
use Mwl91\Tests\Tdd\Builders\CarBuilder;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class FleetTest extends TestCase
{
    private readonly CarBuilder $carBuilder;
    private readonly \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->carBuilder = new CarBuilder();
        $this->faker = \Faker\Factory::create();
    }

    public function testCanCreateFleetId(): void
    {
        // Given:
        $uuid = Uuid::uuid4();

        // When:
        $fleetId = FleetId::tryFrom($uuid);

        // Then:
        $this->assertEquals((string)$fleetId, (string)$uuid);
    }

    public function testCanCreateFleetIdUsingString(): void
    {
        // Given:
        $uuid = Uuid::uuid4()->toString();

        // When:
        $fleetId = FleetId::tryFrom($uuid);

        // Then:
        $this->assertEquals((string)$fleetId, $uuid);
    }

    public function testCanGenerateFleetId(): void
    {
        // When:
        $carId = FleetId::make();

        // Then:
        $this->assertTrue(Uuid::isValid((string)$carId));
    }

    public function testCanCreateNewFleet(): void
    {
        // Given:

        // When:
        $fleet = new Fleet();

        // Then:
        $this->assertInstanceOf(Fleet::class, $fleet);
    }

    public function testCanAddCarToFleet(): void
    {
        // Given:
        $car = $this->carBuilder->getCar();
        $fleet = new Fleet();

        // When:
        $fleet->addCar($car);

        // Then:
        $this->assertCount(1, $fleet);
        $this->assertContains($car, $fleet->getCars());
    }

    public function testFleetMayNotHaveAnyCars(): void
    {
        // Given:
        $fleet = new Fleet();

        // Then:
        $this->assertEmpty($fleet);
        $this->assertCount(0, $fleet);
    }


    public function testCanAddMoreThenOneCar(): void
    {
        // Given:
        $cars = $this->carBuilder->getCars(4);
        $fleet = new Fleet();

        // When:
        $fleet->addCars($cars);

        // Then:
        $this->assertEquals($cars, $fleet->getCars());
        $this->assertCount(count($cars), $fleet);
    }

    public function testCanCreateFleetWithCars(): void
    {
        // Given:
        $cars = $this->carBuilder->getCars(4);

        // When:
        $fleet = new Fleet($cars);

        // Then:
        $this->assertEquals($cars, $fleet->getCars());
        $this->assertCount(count($cars), $fleet);
    }

    public function testCanAddCarsToExistingFleetWithCars(): void
    {
        // Given:
        $initializedCars = $this->carBuilder->getCars(4);
        $newCars = $this->carBuilder->getCars(4);
        $fleet = new Fleet($initializedCars);

        // When:
        $fleet->addCars($newCars);

        // Then:
        $this->assertCount(8, $fleet);
        $this->assertEquals([...$initializedCars, ...$newCars], $fleet->getCars());
    }

    public function testCanRemoveCarFromFleet(): void
    {
        // Given:
        $initialFleetSize = 4;
        $cars = $this->carBuilder->getCars($initialFleetSize);
        $fleet = new Fleet($cars);

        // When:
        $fleet->deleteCar($cars[3]);

        // Then:
        $this->assertCount($initialFleetSize - 1, $fleet);
        $this->assertEquals([$cars[0], $cars[1], $cars[2]], $fleet->getCars());
    }

    public function testCanRemoveCarFromFleetUsingId(): void
    {
        // Given:
        $initialFleetSize = 4;
        $cars = $this->carBuilder->getCars($initialFleetSize);
        $fleet = new Fleet($cars);
        $carId = $cars[3]->getKey();

        // When:
        $fleet->deleteId($carId);

        // Then:
        $this->assertCount($initialFleetSize - 1, $fleet);
        $this->assertEquals([$cars[0], $cars[1], $cars[2]], $fleet->getCars());
    }

    public function testListCars(): void
    {
        // Given:
        $this->expectOutputString("FIAT \nFIAT \nFIAT ");
        $cars = $this->carBuilder->getCars(3);
        $fleet = new Fleet($cars);

        // When:
        $fleetList = (string) $fleet;
        echo $fleetList;

        // Then:
        $this->assertEquals(join(PHP_EOL, array_map(fn(Car $car) => $car->getBrand()->value.' '.$car->getModel(), $fleet->getCars())), $fleetList);
    }

    public function testCanSetInsuranceCost(): void
    {
        // Given:
        $insuranceCost = new Money(100, new Currency("PLN"));
        $cars = $this->carBuilder->getCars(3);
        $fleet = new Fleet($cars);

        // When:
        $fleet->setInsuranceCost($insuranceCost);

        // Then:
        $this->assertEquals($insuranceCost, $fleet->getInsuranceCost());
    }

    public function testCannotSetInsuranceCostLowerThenZero(): void
    {
        // Expect:
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Insurance cost can not be lower than 0");

        // Given:
        $insuranceCost = new Money(-100, new Currency("PLN"));
        $cars = $this->carBuilder->getCars(3);
        $fleet = new Fleet($cars);

        // When:
        $fleet->setInsuranceCost($insuranceCost);
    }

    public function testCanSetCautionPercent(): void
    {
        // Given:
        $percent = 10;
        $fleet = new Fleet();

        // When:
        $fleet->setCautionPercent($percent);

        // Then:
        $this->assertEquals($percent, $fleet->getCautionPercent());
    }

    public function testCannotSetCautionInvalidPercent(): void
    {
        // Given:
        $this->expectException(\OutOfBoundsException::class);
        $percent = -1;
        $fleet = new Fleet();

        // When:
        $fleet->setCautionPercent($percent);

        // Then:
        $this->assertEquals($percent, $fleet->getCautionPercent());
    }

    public function testCannotSetCautionPercentHigherThen100(): void
    {
        // Given:
        $this->expectException(\OutOfBoundsException::class);
        $percent = 101;
        $fleet = new Fleet();

        // When:
        $fleet->setCautionPercent($percent);

        // Then:
        $this->assertEquals($percent, $fleet->getCautionPercent());
    }

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