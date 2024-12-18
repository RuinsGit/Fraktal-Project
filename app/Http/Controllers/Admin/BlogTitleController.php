<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTitle;
use Illuminate\Http\Request;

class BlogTitleController extends Controller
{
    public function index()
    {
        $blogTitles = BlogTitle::all();
        return view('back.blog-title.index', compact('blogTitles'));
    }

    public function create()
    {
        return view('back.blog-title.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
        ]);

        BlogTitle::create([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.blog-title.index')
            ->with('success', 'Başlıq uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $blogTitle = BlogTitle::findOrFail($id);
        return view('back.blog-title.edit', compact('blogTitle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
        ]);

        $blogTitle = BlogTitle::findOrFail($id);
        
        $blogTitle->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'status' => $request->status ?? $blogTitle->status
        ]);

        return redirect()
            ->route('admin.blog-title.index')
            ->with('success', 'Başlıq uğurla yeniləndi');
    }

    public function destroy($id)
    {
        BlogTitle::findOrFail($id)->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Başlıq uğurla silindi'
        ]);
    }

    public function status($id)
    {
        $blogTitle = BlogTitle::findOrFail($id);
        $blogTitle->status = !$blogTitle->status;
        $blogTitle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
