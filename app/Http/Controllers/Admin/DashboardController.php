<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        ini_set('memory_limit', '4096M');
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $previousThirtyDays = Carbon::now()->subDays(60);

        // Satış İstatistikleri
        $totalSales = Order::where('status', '!=', 4)->sum('total_price');
        $currentMonthSales = Order::where('status', '!=', 4)
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->sum('total_price');
        $previousMonthSales = Order::where('status', '!=', 4)
            ->whereBetween('created_at', [$previousThirtyDays, $thirtyDaysAgo])
            ->sum('total_price');
        $salesGrowth = $previousMonthSales > 0 
            ? round((($currentMonthSales - $previousMonthSales) / $previousMonthSales) * 100, 2)
            : 100;


        // Sifariş İstatistikleri
        $totalOrders = Order::count();
        $currentMonthOrders = Order::where('created_at', '>=', $thirtyDaysAgo)->count();
        $previousMonthOrders = Order::whereBetween('created_at', [$previousThirtyDays, $thirtyDaysAgo])->count();
        $orderGrowth = $previousMonthOrders > 0 
            ? round((($currentMonthOrders - $previousMonthOrders) / $previousMonthOrders) * 100, 2)
            : 100;


        // Məhsul İstatistikleri
        $totalProducts = Product::count();
        $currentMonthProducts = Product::where('created_at', '>=', $thirtyDaysAgo)->count();
        $previousMonthProducts = Product::whereBetween('created_at', [$previousThirtyDays, $thirtyDaysAgo])->count();
        $productGrowth = $previousMonthProducts > 0 
            ? round((($currentMonthProducts - $previousMonthProducts) / $previousMonthProducts) * 100, 2)
            : 100;

        // İstifadəçi İstatistikleri
        $totalCustomers = User::count();
        $currentMonthCustomers = User::where('created_at', '>=', $thirtyDaysAgo)->count();
        $previousMonthCustomers = User::whereBetween('created_at', [$previousThirtyDays, $thirtyDaysAgo])->count();
        $customerGrowth = $previousMonthCustomers > 0 
            ? round((($currentMonthCustomers - $previousMonthCustomers) / $previousMonthCustomers) * 100, 2)
            : 100;

        // Son Sifarişlər
        $recentOrders = Order::latest()->take(5)->get();

        // Qrafik Məlumatları
        $chartData = [];
        $chartLabels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartLabels[] = $date->format('F Y');
            
            $monthlySales = Order::where('status', '!=', 4)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_price');
                
            $chartData[] = $monthlySales;
        }

        return view('back.pages.dashboard.index', compact(
            'totalSales',
            'salesGrowth',
            'totalOrders',
            'orderGrowth',
            'totalProducts',
            'productGrowth',
            'totalCustomers',
            'customerGrowth',
            'recentOrders',
            'chartData',
            'chartLabels'
        ));
    }
}