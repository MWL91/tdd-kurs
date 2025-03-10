<?php

namespace Mwl91\Tdd\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fleet;
use Illuminate\Http\JsonResponse;
use Mwl91\Tdd\Infrastructure\Http\Request\FleetListRequest;

class FleetListController extends Controller
{
    public function __invoke(Fleet $fleet, FleetListRequest $request): JsonResponse
    {
        $fleet->load('cars');
        return new JsonResponse($fleet->toArray());
    }
}
