<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Domain;

use Money\Currency;
use Money\Money;
use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Enums\CarBrand;
use Mwl91\Tdd\Domain\Enums\CarClass;
use Mwl91\Tdd\Domain\Enums\CarType;
use Mwl91\Tdd\Domain\Enums\Transmission;
use Mwl91\Tdd\Domain\Enums\Fuel;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\CarId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

#[CoversClass(CarId::class)]
#[CoversClass(Car::class)]
#[Small]
final class CarTest extends TestCase
{
    #[TestDox('ID auta wygenerowany')]
    public function testCanCreateCarId(): void
    {
        // Given:
        $uuid = Uuid::uuid4();

        // When:
        $carId = CarId::tryFrom($uuid);

        // Then:
        $this->assertEquals((string)$carId, (string)$uuid);
    }

    public function testCanGenerateCarId(): void
    {
        // When:
        $carId = CarId::make();

        // Then:
        $this->assertTrue(Uuid::isValid((string)$carId));
    }

    public function testCanCreateCar(): void
    {
        // Given:
        $id = CarId::make();
        $carClass = CarClass::G_PLUS;
        $transmission = Transmission::AUTOMATIC;
        $fuel = Fuel::BENZIN;
        $carType = CarType::HATCHBACK;
        $km = 180;
        $engineCapacity = 1368;
        $price = new Money(130000, new Currency("PLN"));
        $brand = CarBrand::FIAT;
        $model = "Abarth";

        // When:
        $car = new Car(
            $id,
            $carClass,
            $brand,
            $model,
            $carType,
            $price,
            $transmission,
            $fuel,
            $km,
            $engineCapacity
        );

        // Then:
        $this->assertInstanceOf(Car::class, $car);
        $this->assertEquals($id, $car->getKey());
        $this->assertEquals($carClass, $car->getCarClass());
        $this->assertEquals($transmission, $car->getTransmission());
        $this->assertEquals($fuel, $car->getFuel());
        $this->assertEquals($carType, $car->getCarType());
        $this->assertEquals($km, $car->getKm());
        $this->assertEquals($engineCapacity, $car->getEngineCapacity());
        $this->assertEquals($price, $car->getPrice());
        $this->assertEquals($brand, $car->getBrand());
        $this->assertEquals($model, $car->getModel());
    }
}
