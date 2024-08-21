<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Domain\Fleet;

use Money\Currency;
use Money\Money;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tests\Tdd\Builders\CarBuilder;
use PHPUnit\Framework\TestCase;

class FleetInsuranceCostTest extends TestCase
{

    private readonly CarBuilder $carBuilder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->carBuilder = new CarBuilder();
    }

    public function testCanSetInsuranceCost(): void
    {
        // Given:
        $insuranceCost = new Money(100, new Currency("PLN"));
        $cars = $this->carBuilder->getCars(3);
        $fleet = new Fleet($cars);

        // When:
        $fleet->setInsuranceCost($insuranceCost);

        // Then:
        $this->assertEquals($insuranceCost, $fleet->getInsuranceCost());
    }

    public function testCannotSetInsuranceCostLowerThenZero(): void
    {
        // Expect:
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Insurance cost can not be lower than 0");

        // Given:
        $insuranceCost = new Money(-100, new Currency("PLN"));
        $cars = $this->carBuilder->getCars(3);
        $fleet = new Fleet($cars);

        // When:
        $fleet->setInsuranceCost($insuranceCost);
    }
}
