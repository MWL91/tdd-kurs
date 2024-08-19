<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit;

use Mwl91\Tdd\Contracts\CarAttribute;
use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Enums\CarClass;
use Mwl91\Tests\Tdd\DataProviders\CarEnumDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class CarTest extends TestCase
{
    #[DataProviderExternal(CarEnumDataProvider::class, 'carClassDataProvider')]
    #[DataProviderExternal(CarEnumDataProvider::class, 'engineDataProvider')]
    #[DataProviderExternal(CarEnumDataProvider::class, 'fuelDataProvider')]
    #[DataProviderExternal(CarEnumDataProvider::class, 'carBrandDataProvider')]
    public function testEnumExists(string $value, CarAttribute $expectedClass): void
    {
        // Given:

        // When:
        /** @var \UnitEnum $enum */
        $carClass = $expectedClass::tryFrom($value);

        // Then:
        $this->assertEquals($expectedClass, $carClass);
    }


    public function testCanCreateCar(): void
    {
        // Given:
        $carClass = CarClass::B_ELECTRIC;
//        $motor =


        /*
            Rodzaj paliwa
            Ilość koni mechanicznych
            Pojemność silnika
            Wartość samochodu
            Marka
            Model
         */

        // When:
        $car = new Car();

        // Then:
        $this->assertInstanceOf(Car::class, $car);
    }
}