<?php
declare(strict_types=1);
namespace Mwl91\Tests\Tdd\Unit\Domain\Fleet;

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;
use Mwl91\Tests\Tdd\FleetTestCase;

final class FleetCreateTest extends FleetTestCase
{
    public function testCanCreateNewFleet(): void
    {
        // Given:
        $id = FleetId::make();

        // When:
        $fleet = new Fleet($id);

        // Then:
        $this->assertInstanceOf(Fleet::class, $fleet);
    }

    public function testCanAddCarToFleet(): void
    {
        // Given:
        $car = $this->carBuilder->getCar();
        $id = FleetId::make();
        $fleet = new Fleet($id);

        // When:
        $fleet->addCar($car);

        // Then:
        $this->assertCount(1, $fleet);
        $this->assertContains($car, $fleet->getCars());
    }

    public function testFleetMayNotHaveAnyCars(): void
    {
        // Given:
        $id = FleetId::make();
        $fleet = new Fleet($id);

        // Then:
        $this->assertEmpty($fleet);
        $this->assertCount(0, $fleet);
    }


    public function testCanAddMoreThenOneCar(): void
    {
        // Given:
        $cars = $this->carBuilder->getCars(4);
        $id = FleetId::make();
        $fleet = new Fleet($id);

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
        $id = FleetId::make();

        // When:
        $fleet = new Fleet($id, $cars);

        // Then:
        $this->assertEquals($cars, $fleet->getCars());
        $this->assertCount(count($cars), $fleet);
    }

    public function testCanAddCarsToExistingFleetWithCars(): void
    {
        // Given:
        $initializedCars = $this->carBuilder->getCars(4);
        $newCars = $this->carBuilder->getCars(4);
        $id = FleetId::make();
        $fleet = new Fleet($id, $initializedCars);

        // When:
        $fleet->addCars($newCars);

        // Then:
        $this->assertCount(8, $fleet);
        $this->assertEquals([...$initializedCars, ...$newCars], $fleet->getCars());
    }
}
