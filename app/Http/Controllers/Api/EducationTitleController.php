<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationTitleResource;
use App\Models\EducationTitle;
use Illuminate\Http\Request;

class EducationTitleController extends Controller
{
    public function index()
    {
        try {
            $educationTitle = EducationTitle::where('status', true)->first();
            

            if (!$educationTitle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir təhsil başlığı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new EducationTitleResource($educationTitle),
                'message' => 'Təhsil başlıqları uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 