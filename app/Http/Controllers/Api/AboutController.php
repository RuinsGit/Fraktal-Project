<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        try {
            $about = About::first();

            if (!$about) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Haqqımızda məlumatı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new AboutResource($about),
                'message' => 'Haqqımızda məlumatı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 