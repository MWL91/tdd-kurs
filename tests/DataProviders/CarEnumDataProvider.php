<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\DataProviders;

use Mwl91\Tdd\Domain\Enums\CarBrand;
use Mwl91\Tdd\Domain\Enums\CarClass;
use Mwl91\Tdd\Domain\Enums\Engine;
use Mwl91\Tdd\Domain\Enums\Fuel;

final class CarEnumDataProvider
{
    public static function carClassDataProvider(): array
    {
        return [
            ['A', CarClass::A],
            ['B', CarClass::B],
            ['B_ELECTRIC', CarClass::B_ELECTRIC],
            ['C', CarClass::C],
            ['D', CarClass::D],
            ['E', CarClass::E],
            ['F', CarClass::F],
            ['SUV', CarClass::SUV],
            ['C_ELECTRIC', CarClass::C_ELECTRIC],
            ['PREMIUM', CarClass::PREMIUM],
        ];
    }

    public static function engineDataProvider(): array
    {
        return [
            ['MANUAL', Engine::MANUAL],
            ['AUTOMATIC', Engine::AUTOMATIC],
        ];
    }

    public static function fuelDataProvider(): array
    {
        return [
            ['Petrol', Fuel::PETROL],
            ['Diesel', Fuel::DIESEL],
            ['LPG', Fuel::LPG],
            ['CNG', Fuel::CNG],
            ['Electric', Fuel::ELECTRIC],
            ['Hybrid', Fuel::HYBRID],
            ['Hydrogen', Fuel::HYDROGEN],
            ['Biofuel', Fuel::BIOFUEL],
        ];
    }

    public static function carBrandDataProvider(): array
    {
        return [
            ['Fiat', CarBrand::FIAT],
            ['Renault', CarBrand::RENAULT],
            ['Smart', CarBrand::SMART],
            ['Skoda', CarBrand::SKODA],
            ['Mercedes', CarBrand::MERCEDES],
        ];
    }
}