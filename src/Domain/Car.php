<?php

namespace Mwl91\Tdd\Domain;

use Money\Money;
use Mwl91\Tdd\Domain\Enums\CarBrand;
use Mwl91\Tdd\Domain\Enums\CarClass;
use Mwl91\Tdd\Domain\Enums\CarType;
use Mwl91\Tdd\Domain\Enums\Fuel;
use Mwl91\Tdd\Domain\Enums\Transmission;
use Mwl91\Tdd\Domain\ValueObjects\CarId;

final class Car
{
    public function __construct(
        private readonly CarId $id,
        private readonly CarClass $carClass,
        private readonly CarBrand $brand,
        private readonly string $model,
        private readonly CarType $carType,
        private readonly Money $price,
        private readonly Transmission $transmission,
        private readonly Fuel $fuel,
        private readonly int $km,
        private readonly int $engineCapacity,
    )
    {
    }

    public function getKey(): CarId
    {
        return $this->id;
    }

    public function getCarClass(): CarClass
    {
        return $this->carClass;
    }

    public function getTransmission(): Transmission
    {
        return $this->transmission;
    }

    public function getFuel(): Fuel
    {
        return $this->fuel;
    }

    public function getCarType(): CarType
    {
        return $this->carType;
    }

    public function getKm(): int
    {
        return $this->km;
    }

    public function getEngineCapacity(): int
    {
        return $this->engineCapacity;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getBrand(): CarBrand
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }
}