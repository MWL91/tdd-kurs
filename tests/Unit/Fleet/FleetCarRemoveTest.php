<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Fleet;

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tests\Tdd\Builders\CarBuilder;
use PHPUnit\Framework\TestCase;

class FleetCarRemoveTest extends TestCase
{
    private readonly CarBuilder $carBuilder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->carBuilder = new CarBuilder();
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


}