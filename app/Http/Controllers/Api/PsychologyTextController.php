<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PsychologyTextResource;
use App\Models\PsychologyText;
use Illuminate\Http\Request;

class PsychologyTextController extends Controller
{
    public function index()
    {
        try {
            $psychologyTexts = PsychologyText::where('status', true)->get();

            if ($psychologyTexts->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Psixologiya mətnləri tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => PsychologyTextResource::collection($psychologyTexts),
                'message' => 'Psixologiya mətnləri uğurla gətirildi'
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
            $psychologyText = PsychologyText::where('status', true)->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new PsychologyTextResource($psychologyText),
                'message' => 'Psixologiya mətni uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 