<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Size\StoreSizeRequest;
use App\Services\SizeService;
use App\Http\Resources\Options\SizeResource;

class SizeController extends Controller
{
    private $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    public function store(StoreSizeRequest $request)
    {
        $size = $this->sizeService->create($request->validated());
        return (new SizeResource($size))->response()->setStatusCode(201);
    }

    public function destroy(Request $request, $id)
    {
        $this->sizeService->delete($id);
        return response()->json([], 204);
    }

    public function show($id)
    {
        $size = $this->sizeService->show($id);
        return new SizeResource($size);
    }
}
