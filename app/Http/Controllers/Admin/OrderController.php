<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Arama filtresi
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('code', 'LIKE', "%{$request->search}%")
                  ->orWhere('name', 'LIKE', "%{$request->search}%")
                  ->orWhere('email', 'LIKE', "%{$request->search}%");
            });
        }

        // Tarih filtresi
        if ($request->start) {
            $query->whereDate('created_at', '>=', $request->start);
        }
        if ($request->end) {
            $query->whereDate('created_at', '<=', $request->end);
        }

        // Status filtresi
        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Sayfalama
        $limit = $request->limit ?? 10;
        $orders = $query->latest()->paginate($limit);

        return view('back.pages.order.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::with(['order_products.product'])->findOrFail($id);
        
        return view('back.pages.order.detail', compact('order'));
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update(['status' => $request->status]);

            return response()->json([
                'status' => 'success',
                'message' => 'Status uğurla yeniləndi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->order_products()->delete();
            $order->delete();

            return redirect()->route('admin.order.index')
                ->with('success', 'Sifariş uğurla silindi');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sifariş silinərkən xəta baş verdi');
        }
    }
}
