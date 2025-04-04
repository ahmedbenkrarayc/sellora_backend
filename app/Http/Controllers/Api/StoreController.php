<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Http\Requests\Store\CreateStoreRequest;
use App\Http\Requests\Store\UpdateStoreRequest;

class StoreController extends Controller
{
    protected StoreService $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index()
    {
        return response()->json($this->storeService->getAllStores());
    }

    public function show($id)
    {
        return response()->json($this->storeService->getStoreById($id));
    }

    public function store(CreateStoreRequest $request)
    {
        $data = $request->validated();
        $store = $this->storeService->createStore($request->validated());

        return response()->json([
            'message' => 'Store created successfully',
            'store' => $store
        ], 201);
    }

    public function update(UpdateStoreRequest $request, $id)
    {
        $data = $request->validated();
        return response()->json($this->storeService->updateStore($id, $data));
    }

    public function destroy($id)
    {
        return response()->json(['deleted' => $this->storeService->deleteStore($id)]);
    }
}
