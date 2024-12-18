<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvantageResource;
use App\Models\Advantage;
use Illuminate\Http\Request;

class AdvantageController extends Controller
{
    public function index()
    {
        try {
            $advantages = Advantage::where('status', true)->get();

            if ($advantages->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir üstünlük tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => AdvantageResource::collection($advantages),
                'message' => 'Üstünlüklər uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 