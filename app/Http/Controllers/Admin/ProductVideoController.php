<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductVideoController extends Controller
{
    
    public function download(ProductVideo $video)
    {
        try {
            
            $video->increment('download_count');
            
            $path = public_path($video->video_path);
            
            if (!file_exists($path)) {
                return redirect()->back()->with('error', 'Video tapılmadı');
            }
            
            return Response::download($path);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Video yükləmə xətası');
        }
    }

    
    public function updateDuration(Request $request)
    {
        try {
            $request->validate([
                'video_id' => 'required|exists:product_videos,id',
                'duration' => 'required|integer|min:0'
            ]);

            $video = ProductVideo::findOrFail($request->video_id);
            $video->update(['duration' => $request->duration]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 422);
        }
    }

    
    public function incrementView(Request $request)
    {
        try {
            $request->validate([
                'video_id' => 'required|exists:product_videos,id'
            ]);

            $video = ProductVideo::findOrFail($request->video_id);
            $video->increment('view_count');

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 422);
        }
    }

    
    public function rate(Request $request)
    {
        try {
            $request->validate([
                'video_id' => 'required|exists:product_videos,id',
                'rating' => 'required|numeric|min:1|max:5'
            ]);

            $video = ProductVideo::findOrFail($request->video_id);
            $video->update(['rating' => $request->rating]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 422);
        }
    }
}