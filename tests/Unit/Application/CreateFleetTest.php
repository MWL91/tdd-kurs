<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Application;

use Mwl91\Tdd\Application\Commands\CreateFleetCommand;
use Mwl91\Tdd\Application\Commands\CreateFleetCommandHandler;
use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;
use Mwl91\Tdd\Infrastructure\Repositories\Fleet\FleetInMemoryRepository;
use Mwl91\Tests\Tdd\FleetTestCase;

final class CreateFleetTest extends FleetTestCase
{
    public function testCanCreateFleet(): void
    {
        // Given:
        $fleetRepository = new FleetInMemoryRepository();
        $command = new CreateFleetCommand(
            $id = FleetId::make()
        );
        $commandHandler = new CreateFleetCommandHandler($fleetRepository);

        // When:
        $commandHandler($command);

        // Then:
        $this->assertEquals(1, $fleetRepository->count());
        $this->assertInstanceOf(Fleet::class, $fleetRepository->find($id));
    }

}
