<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = SubCategory::with('category')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('back.pages.sub_category.index', compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name_az')
            ->get();
        
        return view('back.pages.sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name_az' => 'required|max:255',
                'name_en' => 'required|max:255',
                'name_ru' => 'required|max:255',
                'image_title_az' => 'required|max:255',
                'image_title_en' => 'required|max:255',
                'image_title_ru' => 'required|max:255',
                'image_alt_az' => 'required|max:255',
                'image_alt_en' => 'required|max:255',
                'image_alt_ru' => 'required|max:255',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|boolean',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
            ], [
                'name_az.required' => 'Ad (AZ) tələb olunur',
                'name_en.required' => 'Ad (EN) tələb olunur',
                'name_ru.required' => 'Ad (RU) tələb olunur',
                'image_title_az.required' => 'Şəkil başlığı (AZ) tələb olunur',
                'image_title_en.required' => 'Şəkil başlığı (EN) tələb olunur',
                'image_title_ru.required' => 'Şəkil başlığı (RU) tələb olunur',
                'image_alt_az.required' => 'Şəkil alt mətni (AZ) tələb olunur',
                'image_alt_en.required' => 'Şəkil alt mətni (EN) tələb olunur',
                'image_alt_ru.required' => 'Şəkil alt mətni (RU) tələb olunur',
                'category_id.required' => 'Kateqoriya seçilməlidir',
                'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil',
                'status.required' => 'Status seçilməlidir',
                'status.boolean' => 'Status yalnız aktiv və ya deaktiv ola bilər',
                'image.required' => 'Şəkil tələb olunur',
                'image.image' => 'Fayl şəkil formatında olmalıdır',
                'image.mimes' => 'Şəkil formatı: jpeg, png, jpg və ya svg olmalıdır',
                'image.max' => 'Şəkil həcmi maksimum 2MB ola bilər'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/sub_categories'), $imageName);
                $imagePath = 'uploads/sub_categories/' . $imageName;
            }

            SubCategory::create([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'image_title_az' => $request->image_title_az,
                'image_title_en' => $request->image_title_en,
                'image_title_ru' => $request->image_title_ru,
                'image_alt_az' => $request->image_alt_az,
                'image_alt_en' => $request->image_alt_en,
                'image_alt_ru' => $request->image_alt_ru,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'slug' => Str::slug($request->name_az),
                'image' => $imagePath
            ]);

            return redirect()
                ->route('admin.sub-category.index')
                ->with('success', 'Alt kateqoriya uğurla əlavə edildi!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $categories = Category::all();
        
        return view('back.pages.sub_category.edit', compact('sub_category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $sub_category = SubCategory::findOrFail($id);

            $request->validate([
                'name_az' => 'required|max:255',
                'name_en' => 'required|max:255',
                'name_ru' => 'required|max:255',
                'image_title_az' => 'required|max:255',
                'image_title_en' => 'required|max:255',
                'image_title_ru' => 'required|max:255',
                'image_alt_az' => 'required|max:255',
                'image_alt_en' => 'required|max:255',
                'image_alt_ru' => 'required|max:255',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ], [
                'name_az.required' => 'Ad (AZ) tələb olunur',
                'name_en.required' => 'Ad (EN) tələb olunur',
                'name_ru.required' => 'Ad (RU) tələb olunur',
                'image_title_az.required' => 'Şəkil başlığı (AZ) tələb olunur',
                'image_title_en.required' => 'Şəkil başlığı (EN) tələb olunur',
                'image_title_ru.required' => 'Şəkil başlığı (RU) tələb olunur',
                'image_alt_az.required' => 'Şəkil alt mətni (AZ) tələb olunur',
                'image_alt_en.required' => 'Şəkil alt mətni (EN) tələb olunur',
                'image_alt_ru.required' => 'Şəkil alt mətni (RU) tələb olunur',
                'category_id.required' => 'Kateqoriya seçilməlidir',
                'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil',
                'status.required' => 'Status seçilməlidir',
                'status.boolean' => 'Status yalnız aktiv və ya deaktiv ola bilər'
            ]);

            if ($request->hasFile('image')) {
                
                if (File::exists(public_path($sub_category->image))) {
                    File::delete(public_path($sub_category->image));
                }

                
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/sub_categories'), $imageName);
                $imagePath = 'uploads/sub_categories/' . $imageName;
            }

            $sub_category->update([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'image_title_az' => $request->image_title_az,
                'image_title_en' => $request->image_title_en,
                'image_title_ru' => $request->image_title_ru,
                'image_alt_az' => $request->image_alt_az,
                'image_alt_en' => $request->image_alt_en,
                'image_alt_ru' => $request->image_alt_ru,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'slug' => Str::slug($request->name_az),
                'image' => $request->hasFile('image') ? $imagePath : $sub_category->image
            ]);

            return redirect()
                ->route('admin.sub-category.index')
                ->with('success', 'Alt kateqoriya uğurla yeniləndi!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);
            
            // Resmi sil
            if (File::exists(public_path($subCategory->image))) {
                File::delete(public_path($subCategory->image));
            }
            
            $subCategory->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Alt kateqoriya uğurla silindi'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ]);
        }
    }
}