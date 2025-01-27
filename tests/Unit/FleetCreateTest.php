<?php

use Mwl91\Tdd\Domain\Car;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tests\Tdd\FleetTestCase;
use function Pest\Faker\fake;

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
    })->group('fleet')
        ->done(
            issue: "PP-123",
            note: <<<NOTE
PHP UnitTests should be refactored
NOTE
        );

    it('should add cars to existing fleet with cars', function () use ($fleet) {});

    it('should process json', function(){
        // Given:
        $array = [
            fake()->numberBetween(1, 10),
            fake()->numberBetween(1, 10),
            fake()->numberBetween(1, 11)
        ];
        $data = fake()->shuffleArray($array);

        // When:
        $json = json_encode($data);

        // Then:
        expect($json)->json()->toContain(...$array);
    })->group('example');
});