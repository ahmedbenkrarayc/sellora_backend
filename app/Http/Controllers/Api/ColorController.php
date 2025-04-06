<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Color\StoreColorRequest;
use App\Services\ColorService;

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
        return response()->json(['data' => $color, 'message' => 'Color created successfully.'], 201);
    }

    public function destroy(Request $request, $id)
    {
        $this->colorService->delete($id);
        return response()->json([], 204);
    }

    public function show($id)
    {
        $color = $this->colorService->show($id);
        return response()->json(['data' => $color]);
    }
}
