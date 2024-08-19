<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Builders;

use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Enums\CarBrand;
use Mwl91\Tdd\Domain\Enums\CarClass;
use Mwl91\Tdd\Domain\Enums\CarType;
use Mwl91\Tdd\Domain\Enums\Fuel;
use Mwl91\Tdd\Domain\Enums\Transmission;
use Mwl91\Tdd\Domain\ValueObjects\CarId;

final class CarBuilder
{
    private CarId $carId;
    private CarClass $carClass;
    private CarBrand $brand;
    private string $model;
    private CarType $carType;
    private int $price;
    private Transmission $transmission;
    private Fuel $fuel;
    private int $km;
    private int $engineCapacity;


    public function getCar(): Car
    {
        return new Car(
            $this->getId(),
            $this->getCarClass(),
            $this->getBrand(),
            $this->getModel(),
            $this->getCarType(),
            $this->getPrice(),
            $this->getTransmission(),
            $this->getFuel(),
            $this->getKm(),
            $this->getEngineCapacity()
        );
    }

    public function getCarClass(): CarClass
    {
        return $this->carClass ?? CarClass::G_PLUS;
    }

    public function setCarClass(CarClass $carClass): void
    {
        $this->carClass = $carClass;
    }

    public function getBrand(): CarBrand
    {
        return $this->brand ?? CarBrand::FIAT;
    }

    public function setBrand(CarBrand $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): string
    {
        return $this->model ?? '';
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getCarType(): CarType
    {
        return $this->carType ?? CarType::HATCHBACK;
    }

    public function setCarType(CarType $carType): void
    {
        $this->carType = $carType;
    }

    public function getPrice(): int
    {
        return $this->price ?? 100000;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getTransmission(): Transmission
    {
        return $this->transmission ?? Transmission::AUTOMATIC;
    }

    public function setTransmission(Transmission $transmission): void
    {
        $this->transmission = $transmission;
    }

    public function getFuel(): Fuel
    {
        return $this->fuel ?? Fuel::BENZIN;
    }

    public function setFuel(Fuel $fuel): void
    {
        $this->fuel = $fuel;
    }

    public function getKm(): int
    {
        return $this->km ?? 100;
    }

    public function setKm(int $km): void
    {
        $this->km = $km;
    }

    public function getEngineCapacity(): int
    {
        return $this->engineCapacity ?? 1000;
    }

    public function setEngineCapacity(int $engineCapacity): void
    {
        $this->engineCapacity = $engineCapacity;
    }

    public function getCars(int $quantity): array
    {
        $cars = [];

        while($quantity-- > 0) {
            $cars[] = $this->getCar();
        }

        return $cars;
    }

    public function getId(): CarId
    {
        return $this->carId ?? CarId::make();
    }

    public function setCarId(CarId $carId): void
    {
        $this->carId = $carId;
    }

}