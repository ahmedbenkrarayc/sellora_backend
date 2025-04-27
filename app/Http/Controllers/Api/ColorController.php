<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Color\StoreColorRequest;
use App\Services\ColorService;
use App\Http\Resources\Options\ColorResource;

class ColorController extends Controller
{
    private $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    public function store(StoreColorRequest $request)
    {
        $color = $this->colorService->create($request->validated());
        return (new ColorResource($color))->response()->setStatusCode(201);
    }

    public function destroy(Request $request, $id)
    {
        $this->colorService->delete($id);
        return response()->json([], 204);
    }

    public function show($id)
    {
        $color = $this->colorService->show($id);
        return new ColorResource($color);
    }
}
