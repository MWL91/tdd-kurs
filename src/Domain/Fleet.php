<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Domain;

use Money\Money;
use Mwl91\Tdd\Domain\ValueObjects\CarId;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;

final class Fleet implements \Countable
{
    public function __construct(
        private FleetId $id,
        private array  $cars = [],
        private ?Money $insuranceCost = null,
        private int    $cautionPercent = 0,
        private ?ValueObjects\PickupPolicy $pickupPolicy = null,
    )
    {
    }

    public function getKey(): FleetId
    {
        return $this->id;
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

    public function deleteCar(Car $car): void
    {
        $this->cars = array_filter($this->cars, fn(Car $existingCar) => $existingCar !== $car);
    }

    public function deleteId(CarId $carId): void
    {
        $this->cars = array_filter($this->cars, fn(Car $existingCar) => $existingCar->getKey() !== $carId);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function setInsuranceCost(Money $insuranceCost): void
    {
        if($insuranceCost->isNegative()) {
            throw new \InvalidArgumentException("Insurance cost can not be lower than 0");
        }

        $this->insuranceCost = $insuranceCost;
    }

    public function getInsuranceCost(): Money
    {
        return $this->insuranceCost;
    }

    public function setCautionPercent(int $percent): void
    {
        if($percent < 0 || $percent > 100) {
            throw new \OutOfBoundsException("Percent must be between 0 and 100");
        }

        $this->cautionPercent = $percent;
    }

    public function getCautionPercent(): int
    {
        return $this->cautionPercent;
    }

    public function __toString(): string
    {
        return join(PHP_EOL, array_map(fn(Car $car) => $car->getBrand()->value.' '.$car->getModel(), $this->cars));
    }

    public function setPickupPolicy(ValueObjects\PickupPolicy $pickupPolicy): void
    {
        $this->pickupPolicy = $pickupPolicy;
    }

    public function getOfficePickupCost(): Money
    {
        return $this->pickupPolicy->getOfficePickupCost();
    }

    public function getAirportPickupCost(): Money
    {
        return $this->pickupPolicy->getAirportPickupCost();
    }

    public function getAddressPickupCost(): Money
    {
        return $this->pickupPolicy->getAddressPickupCost();
    }

    public function getOvertimePickupCost(): Money
    {
        return $this->pickupPolicy->getOvertimePickupCost();
    }

}
