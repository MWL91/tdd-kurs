<?php

namespace Mwl91\Tdd\Domain;

use Mwl91\Tdd\Domain\Enums\CarBrand;
use Mwl91\Tdd\Domain\Enums\CarClass;
use Mwl91\Tdd\Domain\Enums\CarType;
use Mwl91\Tdd\Domain\Enums\Fuel;
use Mwl91\Tdd\Domain\Enums\Transmission;

final class Car
{
    public function __construct(
        private readonly CarClass $carClass,
        private readonly CarBrand $brand,
        private readonly string $model,
        private readonly CarType $carType,
        private readonly int $price,
        private readonly Transmission $transmission,
        private readonly Fuel $fuel,
        private readonly int $km,
        private readonly int $engineCapacity,
    )
    {
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

    public function getPrice(): int
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