<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('back.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('back.pages.category.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_az' => 'required',
                'name_en' => 'required',
                'name_ru' => 'required',
            ], [
                'name_az.required' => 'Azərbaycan dilində ad daxil edilməlidir',
                'name_en.required' => 'İngilis dilində ad daxil edilməlidir',
                'name_ru.required' => 'Rus dilində ad daxil edilməlidir',
            ]);

            $category = new Category();
            $category->name_az = $request->name_az;
            $category->name_en = $request->name_en;
            $category->name_ru = $request->name_ru;
            $category->slug = Str::slug($request->name_az);
            $category->status = 1;
            
            if($category->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kateqoriya müvəffəqiyyətlə əlavə edildi'
                ]);
            }

            throw new \Exception('Kateqoriya əlavə edilərkən xəta baş verdi');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 422);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('back.pages.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Kateqoriya yeniləndi');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Kateqoriya silindi');
    }
}