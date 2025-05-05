<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;

class StatisticsController extends Controller
{
    public function adminStatistics()
    {
        $storeCount = Store::count();
        $storeOwnerCount = User::where('role', 'storeowner')->count();
        $orderCount = Order::count();
    
        $latestStores = Store::latest()->take(10)->get();

        $storesByType = Store::selectRaw('type, COUNT(*) as total')
            ->groupBy('type')
            ->get();
    
        $ordersByStore = Order::selectRaw('customer.store_id, COUNT(*) as total, store.name as store_name')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->leftJoin('store', 'customer.store_id', '=', 'store.id')
            ->groupBy('customer.store_id', 'store.name')
            ->orderByDesc('total')
            ->take(10)
            ->get()
            ->map(function ($order) {
                return [
                    'store' => $order->store_name ?? 'Unknown',
                    'total' => $order->total,
                ];
            });
        
    
        return response()->json([
            'store_count' => $storeCount,
            'store_owner_count' => $storeOwnerCount,
            'order_count' => $orderCount,
            'latest_stores' => $latestStores,
            'stores_by_type' => $storesByType,
            'orders_by_store' => $ordersByStore,
        ]);
    }

    public function storeOwnerStatistics($storeId)
    {
        $orderCount = Order::whereHas('customer', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->count();

        $totalRevenue = Order::whereHas('customer', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->sum('price');

        $productCount = Product::whereHas('subcategory.category', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->count();

        $latestOrders = Order::whereHas('customer', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->latest()->take(10)->get();

        $ordersByMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereHas('customer', function ($query) use ($storeId) {
                $query->where('store_id', $storeId);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $revenueByMonth = Order::selectRaw('MONTH(created_at) as month, SUM(price) as total_revenue')
            ->whereHas('customer', function ($query) use ($storeId) {
                $query->where('store_id', $storeId);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json([
            'order_count' => $orderCount,
            'total_revenue' => $totalRevenue,
            'product_count' => $productCount,
            'latest_orders' => $latestOrders,
            'orders_by_month' => $ordersByMonth,
            'revenue_by_month' => $revenueByMonth,
        ]);
    }
    
}
