<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogType;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class BlogTypeController extends Controller
{
    public function index()
    {
        $blogTypes = BlogType::all();
        return view('admin.blog-types.index', compact('blogTypes'));
    }

    public function create()
    {
        return view('admin.blog-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        BlogType::create($data);

        Toastr::success('Blog növü uğurla əlavə edildi');
        return redirect()->route('admin.blog-types.index');
    }

    public function edit(BlogType $blogType)
    {
        return view('admin.blog-types.edit', compact('blogType'));
    }

    public function update(Request $request, BlogType $blogType)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        $blogType->update($data);

        Toastr::success('Blog növü uğurla yeniləndi');
        return redirect()->route('admin.blog-types.index');
    }

    public function destroy(BlogType $blogType)
    {
        $blogType->delete();
        
        Toastr::success('Blog növü uğurla silindi');
        return redirect()->route('admin.blog-types.index');
    }
} 