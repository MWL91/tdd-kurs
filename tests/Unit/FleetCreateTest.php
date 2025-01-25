<?php

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tests\Tdd\FleetTestCase;

uses(FleetTestCase::class);

describe('Fleet create', function() {
    $fleet = new Fleet();

    it('should create fleet', fn() => expect($fleet)->toBeInstanceOf(Fleet::class));

    it('should add car to fleet', function() use ($fleet) {
        // Given:
        $car = $this->carBuilder->getCar();

        // When:
        $fleet->addCar($car);

        // Then:
        expect($fleet)->toHaveCount(1)
            ->and($fleet->getCars())->toContain($car);
    });
});