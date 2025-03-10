<?php

namespace Mwl91\Tdd\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mwl91\Tdd\Application\Commands\CreateFleetCommand;
use Mwl91\Tdd\Application\Commands\CreateFleetCommandHandler;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;

class FleetCreateController extends Controller
{
    public function __construct(
        private CreateFleetCommandHandler $handler
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $fleetId = FleetId::make();
        $command = new CreateFleetCommand($fleetId);
        $this->handler->__invoke($command);

        return new JsonResponse(['created' => true, 'fleetId' => $fleetId->getId()], 201);
    }
}
