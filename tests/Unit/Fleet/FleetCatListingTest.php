<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Fleet;

use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tests\Tdd\Builders\CarBuilder;
use PHPUnit\Framework\TestCase;

class FleetCatListingTest extends TestCase
{
    private readonly CarBuilder $carBuilder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->carBuilder = new CarBuilder();
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
}