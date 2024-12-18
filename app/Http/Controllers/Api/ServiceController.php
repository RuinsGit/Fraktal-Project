<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $services = Service::where('status', true)
                             ->latest()
                             ->get();

            if ($services->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Xidmətlər tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => ServiceResource::collection($services),
                'message' => 'Xidmətlər uğurla gətirildi'
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
            $service = Service::where('status', true)
                            ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new ServiceResource($service),
                'message' => 'Xidmət uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 