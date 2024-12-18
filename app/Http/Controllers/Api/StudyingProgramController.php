<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudyingProgramResource;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyingProgramController extends Controller
{
    public function index()
    {
        try {
            \Log::info('Trying to fetch StudyingProgram');
            
            $studyingProgram = StudyProgram::where('status', 1)->first();
            
            \Log::info('StudyingProgram Query Result:', [
                'data' => $studyingProgram ? $studyingProgram->toArray() : null
            ]);

            if (!$studyingProgram) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir təhsil proqramı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new StudyingProgramResource($studyingProgram),
                'message' => 'Təhsil proqramı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            \Log::error('StudyingProgram Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage(),
                'debug_info' => [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ], 500);
        }
    }
} 