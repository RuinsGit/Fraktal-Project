<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        try {
            $companies = Company::where('status', true)
                             ->first();

            // if ($companies->isEmpty()) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Şirkətlər tapılmadı'
            //     ], 404);
            // }

            return response()->json([
                'status' => 'success',
                'data' => new CompanyResource($companies),
                'message' => 'Şirkətlər uğurla gətirildi'
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
            $company = Company::where('status', true)
                            ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new CompanyResource($company),
                'message' => 'Şirkət uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
}