<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit;

use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Enums\CarClass;
use PHPUnit\Framework\TestCase;

final class CarTest extends TestCase
{


    public function testCanCreateCar(): void
    {
        // Given:

        // When:
        $car = new Car();

        // Then:
        $this->assertInstanceOf(Car::class, $car);
    }
}