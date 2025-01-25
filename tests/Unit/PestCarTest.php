<?php

use Money\Currency;
use Money\Money;
use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Enums\CarBrand;
use Mwl91\Tdd\Domain\Enums\CarClass;
use Mwl91\Tdd\Domain\Enums\CarType;
use Mwl91\Tdd\Domain\Enums\Fuel;
use Mwl91\Tdd\Domain\Enums\Transmission;
use Mwl91\Tdd\Domain\ValueObjects\CarId;

describe('Car test', function(){
    it('should create car', function() {
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
        expect($car)->toBeInstanceOf(Car::class)
            ->and($car->getKey())->toBe($id)
            ->and($car->getCarClass())->toBe($carClass)
            ->and($car->getTransmission())->toBe($transmission)
            ->and($car->getFuel())->toBe($fuel)
            ->and($car->getKm())->toBe($km)
            ->and($car->getEngineCapacity())->toBe($engineCapacity)
            ->and($car->getPrice())->toBe($price)
            ->and($car->getBrand())->toBe($brand)
            ->and($car->getModel())->toBe($model);
    });
});