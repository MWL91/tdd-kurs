<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit;

use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Fleet;
use PHPUnit\Framework\TestCase;

final class FleetTest extends TestCase
{
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
        $car = new Car();
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
        $cars = [new Car(), new Car(), new Car(), new Car()];
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
        $cars = [new Car(), new Car(), new Car(), new Car()];

        // When:
        $fleet = new Fleet($cars);

        // Then:
        $this->assertEquals($cars, $fleet->getCars());
        $this->assertCount(count($cars), $fleet);
    }

    public function testCanAddCarsToExistingFleetWithCars(): void
    {
        // Given:
        $initializedCars = [new Car(), new Car(), new Car(), new Car()];
        $newCars = [new Car(), new Car(), new Car(), new Car()];
        $fleet = new Fleet($initializedCars);

        // When:
        $fleet->addCars($newCars);

        // Then:
        $this->assertCount(8, $fleet);
        $this->assertEquals([...$initializedCars, ...$newCars], $fleet->getCars());
    }


}