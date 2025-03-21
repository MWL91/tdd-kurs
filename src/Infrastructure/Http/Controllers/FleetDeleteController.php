<?php

namespace Mwl91\Tdd\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mwl91\Tdd\Application\Commands\CreateFleetCommand;
use Mwl91\Tdd\Application\Commands\CreateFleetCommandHandler;
use Mwl91\Tdd\Application\Commands\DeleteFleetCommand;
use Mwl91\Tdd\Application\Commands\DeleteFleetCommandHandler;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;

class FleetDeleteController extends Controller
{
    public function __construct(
        private DeleteFleetCommandHandler $handler
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $fleetId = FleetId::tryFrom($request->route('fleet'));
        $command = new DeleteFleetCommand($fleetId);
        $this->handler->__invoke($command);
        return new JsonResponse([], 204);
    }
}
