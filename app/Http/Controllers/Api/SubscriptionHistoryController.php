<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionHistory;

class SubscriptionHistoryController extends Controller
{
    public function index(){
        $history = SubscriptionHistory::with('user.store')
        ->orderBy('recorded_at', 'desc')
        ->get();
        return response()->json($history);
    }
}
