<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Application\Commands;

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Infrastructure\Repositories\Fleet\FleetRepository;

final class CreateFleetCommandHandler
{
    public function __construct(
        private readonly FleetRepository $fleetRepository
    )
    {
    }

    public function __invoke(CreateFleetCommand $command): void
    {
        $fleet = new Fleet($command->getFleetId());
        $this->fleetRepository->create($fleet);
    }
}
