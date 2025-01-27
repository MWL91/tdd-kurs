<?php

use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Enums\Fuel;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tests\Tdd\FleetTestCase;

uses(FleetTestCase::class);

describe('Fleet create', function() {
    $fleet = new Fleet();

    beforeEach(function() use($fleet) {
        $cars = $fleet->getCars();
        foreach ($cars as $car) {
            $fleet->deleteCar($car);
        }
    });

    it(
        'should create fleet',
        fn() => expect($fleet)->toBeInstanceOf(Fleet::class)
    )->group('fleet');

    it('should add car to fleet', function() use ($fleet) {
        // Given:
        $car = $this->carBuilder->getCar();

        // When:
        $fleet->addCar($car);

        // Then:
        expect($fleet)->toHaveCount(1)
            ->and($fleet->getCars())->toContain($car);
    })->group('fleet');

    it('should create fleet with many cars', function () use ($fleet) {
        // Given:
        $cars = $this->carBuilder->getCars(rand(2,10));

        // When:
        $fleet->addCars($cars);

        // Then:
        expect($fleet)->toHaveCount(count($cars))
            ->and($fleet->getCars())->each->toBeInstanceOf(Car::class);
    })->group('fleet');

    it('should process json', function(){
        // Given:
        $data = [1, 2, 3];

        // When:
        $json = json_encode($data);

        // Then:
        expect($json)->json()->toBe([1, 2, 3])->not->toBe('[1,2,3]');
    })->group('example');
});