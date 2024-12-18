<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeaderResource;
use App\Models\Header;

class HeaderController extends Controller
{
    public function index()
    {
        try {
            $headers = Header::first();
            return new HeaderResource($headers);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id){
        try {
            $header = Header::findOrFail($id);
            return new HeaderResource($header);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Header not found'
            ], 404);            
        }
    }
}