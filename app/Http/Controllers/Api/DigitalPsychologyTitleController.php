<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DigitalPsychologyTitleResource;
use App\Models\DigitalPsychologyTitle;
use Illuminate\Http\Request;

class DigitalPsychologyTitleController extends Controller
{
    public function index()
    {
        try {
            $digitalPsychologyTitle = DigitalPsychologyTitle::where('status', true)->first();

            if (!$digitalPsychologyTitle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Rəqəmsal psixologiya başlığı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new DigitalPsychologyTitleResource($digitalPsychologyTitle),
                'message' => 'Rəqəmsal psixologiya başlığı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 