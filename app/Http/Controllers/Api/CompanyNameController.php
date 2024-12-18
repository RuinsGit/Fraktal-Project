<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyNameResource;
use App\Models\CompanyName;
use Illuminate\Http\Request;

class CompanyNameController extends Controller
{
    public function index()
    {
        try {
            $companyName = CompanyName::where('status', 1)->first();

            if (!$companyName) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir şirkət adı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new CompanyNameResource($companyName),
                'message' => 'Şirkət adı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 