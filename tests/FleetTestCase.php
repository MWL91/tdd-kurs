<?php

namespace Mwl91\Tests\Tdd;

use Mwl91\Tests\Tdd\Builders\CarBuilder;
use PHPUnit\Framework\TestCase;

abstract class FleetTestCase extends TestCase
{
    protected readonly CarBuilder $carBuilder;
    protected readonly \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->carBuilder = new CarBuilder();
        $this->faker = \Faker\Factory::create();
    }
}