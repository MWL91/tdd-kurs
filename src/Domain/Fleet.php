<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Domain;

final class Fleet implements \Countable
{
    public function __construct(
        private array $cars = []
    )
    {
    }

    public function addCar(Car $car): void
    {
        $this->cars[] = $car;
    }

    public function count(): int
    {
        return count($this->cars);
    }

    public function getCars(): array
    {
        return $this->cars;
    }

    public function addCars(array $cars): void
    {
        $this->cars = [...$this->cars, ...$cars];
    }
}