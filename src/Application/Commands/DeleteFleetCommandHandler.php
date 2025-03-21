<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Application\Commands;

use Mwl91\Tdd\Infrastructure\Repositories\Fleet\FleetRepository;

final class DeleteFleetCommandHandler
{
    public function __construct(
        private readonly FleetRepository $fleetRepository
    )
    {
    }

    public function __invoke(DeleteFleetCommand $command): void
    {
        $this->fleetRepository->delete($command->getFleetId());
    }
}