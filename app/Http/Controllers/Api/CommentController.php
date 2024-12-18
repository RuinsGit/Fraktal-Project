<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        try {
            $comments = Comment::where('status', true)
                             ->latest()
                             ->get();

            if ($comments->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Rəylər tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => CommentResource::collection($comments),
                'message' => 'Rəylər uğurla gətirildi'
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
            $comment = Comment::where('status', true)
                            ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new CommentResource($comment),
                'message' => 'Rəy uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 