<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        
        $latestOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();
        
        $lowStockProducts = Product::where('stock', '<', 10)
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCustomers',
            'pendingOrders',
            'completedOrders',
            'latestOrders',
            'lowStockProducts'
        ));
    }
}
