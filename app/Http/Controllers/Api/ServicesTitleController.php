<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServicesTitleResource;
use App\Models\ServicesTitle;
use Illuminate\Http\Request;

class ServicesTitleController extends Controller
{
    public function index()
    {
        try {
            $servicesTitle = ServicesTitle::first();

            if (!$servicesTitle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Xidmətlər başlığı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new ServicesTitleResource($servicesTitle),
                'message' => 'Xidmətlər başlığı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 