<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Fleet;

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tests\Tdd\Builders\CarBuilder;
use Mwl91\Tests\Tdd\FleetTestCase;
use PHPUnit\Framework\TestCase;

final class FleetCarsCreateTest extends FleetTestCase
{

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
}