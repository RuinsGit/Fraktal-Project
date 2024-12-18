<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Http\Requests\Admin\LeaderRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    public function index()
    {
        $leaders = Leader::latest()->get();
        return view('back.pages.leader.index', compact('leaders'));
    }

    public function create()
    {
        return view('back.pages.leader.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_az' => 'required',
                'name_en' => 'required',
                'name_ru' => 'required',
                'position_az' => 'required',
                'position_en' => 'required',
                'position_ru' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
            ], [
                'name_az.required' => 'Azərbaycan dilində ad daxil edilməlidir',
                'name_en.required' => 'İngilis dilində ad daxil edilməlidir',
                'name_ru.required' => 'Rus dilində ad daxil edilməlidir',
                'position_az.required' => 'Azərbaycan dilində vəzifə daxil edilməlidir',
                'position_en.required' => 'İngilis dilində vəzifə daxil edilməlidir',
                'position_ru.required' => 'Rus dilində vəzifə daxil edilməlidir',
                'image.required' => 'Şəkil mütləq yüklənməlidir',
                'image.image' => 'Fayl şəkil formatında olmalıdır',
                'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, svg olmalıdır',
                'image.max' => 'Şəkil maksimum 2MB ola bilər'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/leaders'), $imageName);
                $imagePath = 'uploads/leaders/' . $imageName;
            }

            Leader::create([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'position_az' => $request->position_az,
                'position_en' => $request->position_en,
                'position_ru' => $request->position_ru,
                'image' => $imagePath ?? null
            ]);

            toastr()->success('Rəhbər müvəffəqiyyətlə əlavə edildi');
            return redirect()->route('admin.leader.index');

        } catch (\Exception $e) {
            toastr()->error('Xəta: ' . $e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        $leader = Leader::findOrFail($id);
        return view('back.pages.leader.edit', compact('leader'));
    }

    public function update(Request $request, $id)
    {
        try {
            $leader = Leader::findOrFail($id);

            $request->validate([
                'name_az' => 'required',
                'name_en' => 'required',
                'name_ru' => 'required',
                'position_az' => 'required',
                'position_en' => 'required',
                'position_ru' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ], [
                'name_az.required' => 'Azərbaycan dilində ad daxil edilməlidir',
                'name_en.required' => 'İngilis dilində ad daxil edilməlidir',
                'name_ru.required' => 'Rus dilində ad daxil edilməlidir',
                'position_az.required' => 'Azərbaycan dilində vəzifə daxil edilməlidir',
                'position_en.required' => 'İngilis dilində vəzifə daxil edilməlidir',
                'position_ru.required' => 'Rus dilində vəzifə daxil edilməlidir',
                'image.image' => 'Fayl şəkil formatında olmalıdır',
                'image.mimes' => 'Şəkil formatı: jpeg, png, jpg, svg olmalıdır',
                'image.max' => 'Şəkil maksimum 2MB ola bilər'
            ]);

            if ($request->hasFile('image')) {
                // Köhnə şəkli sil
                if ($leader->image && file_exists(public_path($leader->image))) {
                    unlink(public_path($leader->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/leaders'), $imageName);
                $imagePath = 'uploads/leaders/' . $imageName;
            }

            $leader->update([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'position_az' => $request->position_az,
                'position_en' => $request->position_en,
                'position_ru' => $request->position_ru,
                'image' => $request->hasFile('image') ? $imagePath : $leader->image
            ]);

            toastr()->success('Rəhbər müvəffəqiyyətlə yeniləndi');
            return redirect()->route('admin.leader.index');

        } catch (\Exception $e) {
            toastr()->error('Xəta: ' . $e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $leader = Leader::findOrFail($id);

            if (File::exists(public_path($leader->image))) {
                File::delete(public_path($leader->image));
            }

            $leader->delete();

            return redirect()
                ->route('admin.leader.index')
                ->with('success', 'Rəhbər uğurla silindi!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta: ' . $e->getMessage());
        }
    }
}