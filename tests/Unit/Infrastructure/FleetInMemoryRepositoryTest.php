<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Infrastructure;

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;
use Mwl91\Tdd\Infrastructure\Repositories\Fleet\FleetInMemoryRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FleetInMemoryRepositoryTest extends TestCase
{
    public function testCanCountFleets(): void
    {
        // Given:
        $fleetRepository = new FleetInMemoryRepository();
        $id = FleetId::make();
        $fleet = new Fleet($id);

        // When:
        $fleetRepository->create($fleet);

        // Then:
        $this->assertEquals(1, $fleetRepository->count());
        $this->assertEquals($fleet, $fleetRepository->find($id));
    }

    #[Test]
    public function canCreateTwoFleets(): void
    {
        // Given:
        $fleetRepository = new FleetInMemoryRepository();
        $id = FleetId::make();
        $fleet = new Fleet($id);
        $id2 = FleetId::make();
        $fleet2 = new Fleet($id2);

        // When:
        $fleetRepository->create($fleet);
        $fleetRepository->create($fleet2);

        // Then:
        $this->assertEquals(2, $fleetRepository->count());
        $this->assertEquals($fleet, $fleetRepository->find($id));
        $this->assertEquals($fleet2, $fleetRepository->find($id2));
    }

}
