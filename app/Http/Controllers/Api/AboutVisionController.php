<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutVisionResource;
use App\Models\AboutVision;
use Illuminate\Http\Request;

class AboutVisionController extends Controller
{
    public function index()
    {
        try {
            $vision = AboutVision::where('status', true)->first();

            if (!$vision) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vizyon məlumatı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new AboutVisionResource($vision),
                'message' => 'Vizyon məlumatı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 