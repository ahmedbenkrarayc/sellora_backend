<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return response()->json($this->orderService->getAll());
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->create($request->validated());
        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = $this->orderService->getById($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, $id)
    {
        $order = $this->orderService->updateStatus($id, $request->status);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order);
    }

    public function destroy($id)
    {
        $deleted = $this->orderService->delete($id);
        if ($deleted) {
            return response()->json([], 204);
        }
        return response()->json(['message' => 'Order not found'], 404);
    }
}
