<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaderResource;
use App\Models\Leader;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    public function index()
    {
        try {
            $leaders = Leader::latest()->get();

            if ($leaders->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Rəhbərlər tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => LeaderResource::collection($leaders),
                'message' => 'Rəhbərlər uğurla gətirildi'
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
            $leader = Leader::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new LeaderResource($leader),
                'message' => 'Rəhbər uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 