<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Domain\Fleet;

use Mwl91\Tdd\Domain\ValueObjects\FleetId;
use Mwl91\Tests\Tdd\Unit\Domain\Fleet\DeliveryCostTest;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class FleetIdTest extends TestCase
{
    public function testCanGenerateFleetId(): void
    {
        // When:
        $fleetId = FleetId::make();

        // Then:
        $this->assertTrue(Uuid::isValid((string)$fleetId));
    }

    public function testCanGetGeneratedId(): void
    {
        // Given:
        $fleetId = FleetId::make();

        // When:
        $uuid = $fleetId->getId();

        // Then:
        $this->assertInstanceOf(UuidInterface::class, $uuid);
        $this->assertEquals($fleetId->__toString(), $uuid->__toString());
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
