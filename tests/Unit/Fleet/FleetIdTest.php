<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Fleet;

use Mwl91\Tdd\Domain\ValueObjects\FleetId;
use Mwl91\Tests\Tdd\Unit\Fleet\DeliveryCostTest;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class FleetIdTest extends TestCase
{
    public function testCanGenerateFleetId(): void
    {
        // When:
        $carId = FleetId::make();

        // Then:
        $this->assertTrue(Uuid::isValid((string)$carId));
    }

    public function testCanCreateFleetId(): void
    {
        // Given:
        $uuid = Uuid::uuid4();

        // When:
        $fleetId = FleetId::tryFrom($uuid);

        // Then:
        $this->assertEquals((string)$fleetId, (string)$uuid);
    }

    public function testCanCreateFleetIdUsingString(): void
    {
        // Given:
        $uuid = Uuid::uuid4()->toString();

        // When:
        $fleetId = FleetId::tryFrom($uuid);

        // Then:
        $this->assertEquals((string)$fleetId, $uuid);
    }
}