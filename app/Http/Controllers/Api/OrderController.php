<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Order::query();

            // Status filtresi
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Tarih filtresi
            if ($request->start_date) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->end_date) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            $orders = $query->latest()->paginate($request->per_page ?? 10);

            return response()->json([
                'status' => 'success',
                'data' => OrderResource::collection($orders),
                'pagination' => [
                    'total' => $orders->total(),
                    'per_page' => $orders->perPage(),
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage()
                ],
                'message' => 'Sifarişlər uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $order = Order::with('order_products')->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new OrderResource($order),
                'message' => 'Sifariş uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 