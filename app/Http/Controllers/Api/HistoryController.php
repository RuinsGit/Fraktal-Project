<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        try {
            $histories = History::where('status', true)
                              ->orderBy('number', 'asc')
                              ->get();

            if ($histories->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir tarix məlumatı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => HistoryResource::customCollection($histories),
                'message' => 'Tarix məlumatları uğurla gətirildi'
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
            $history = History::where('status', true)->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new HistoryResource($history),
                'message' => 'Tarix məlumatı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 