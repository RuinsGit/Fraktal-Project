<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeTitleController extends Controller
{
    public function index()
    {
        $titles = HomeTitle::latest()->get();
        return view('back.home.title.index', compact('titles'));
    }

    public function create()
    {
        return view('back.home.title.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_1_az' => 'nullable|string|max:255',
                'name_1_en' => 'nullable|string|max:255',
                'name_1_ru' => 'nullable|string|max:255',
                'name_2_az' => 'nullable|string|max:255',
                'name_2_en' => 'nullable|string|max:255',
                'name_2_ru' => 'nullable|string|max:255',
                'name_3_az' => 'nullable|string|max:255',
                'name_3_en' => 'nullable|string|max:255',
                'name_3_ru' => 'nullable|string|max:255',
                'name_4_az' => 'nullable|string|max:255',
                'name_4_en' => 'nullable|string|max:255',
                'name_4_ru' => 'nullable|string|max:255',
                'name_5_az' => 'nullable|string|max:255',
                'name_5_en' => 'nullable|string|max:255',
                'name_5_ru' => 'nullable|string|max:255',
                'name_6_az' => 'nullable|string|max:255',
                'name_6_en' => 'nullable|string|max:255',
                'name_6_ru' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/titles'), $imageName);
                $imagePath = 'uploads/titles/' . $imageName;
            }

            HomeTitle::create([
                'name_1_az' => $request->name_1_az,
                'name_1_en' => $request->name_1_en,
                'name_1_ru' => $request->name_1_ru,
                'name_2_az' => $request->name_2_az,
                'name_2_en' => $request->name_2_en,
                'name_2_ru' => $request->name_2_ru,
                'name_3_az' => $request->name_3_az,
                'name_3_en' => $request->name_3_en,
                'name_3_ru' => $request->name_3_ru,
                'name_4_az' => $request->name_4_az,
                'name_4_en' => $request->name_4_en,
                'name_4_ru' => $request->name_4_ru,
                'name_5_az' => $request->name_5_az,
                'name_5_en' => $request->name_5_en,
                'name_5_ru' => $request->name_5_ru,
                'name_6_az' => $request->name_6_az,
                'name_6_en' => $request->name_6_en,
                'name_6_ru' => $request->name_6_ru,
                'image' => $imagePath ?? null,
                'status' => 1
            ]);

            toastr()->success('Başlık uğurla əlavə edildi');
            return redirect()->route('admin.home.title.index');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        $title = HomeTitle::findOrFail($id);
        return view('back.home.title.edit', compact('title'));
    }

    public function update(Request $request, $id)
    {
        try {
            $title = HomeTitle::findOrFail($id);

            $validated = $request->validate([
                'name_1_az' => 'nullable|string|max:255',
                'name_1_en' => 'nullable|string|max:255',
                'name_1_ru' => 'nullable|string|max:255',
                'name_2_az' => 'nullable|string|max:255',
                'name_2_en' => 'nullable|string|max:255',
                'name_2_ru' => 'nullable|string|max:255',
                'name_3_az' => 'nullable|string|max:255',
                'name_3_en' => 'nullable|string|max:255',
                'name_3_ru' => 'nullable|string|max:255',
                'name_4_az' => 'nullable|string|max:255',
                'name_4_en' => 'nullable|string|max:255',
                'name_4_ru' => 'nullable|string|max:255',
                'name_5_az' => 'nullable|string|max:255',
                'name_5_en' => 'nullable|string|max:255',
                'name_5_ru' => 'nullable|string|max:255',
                'name_6_az' => 'nullable|string|max:255',
                'name_6_en' => 'nullable|string|max:255',
                'name_6_ru' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                if ($title->image && File::exists(public_path($title->image))) {
                    File::delete(public_path($title->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/titles'), $imageName);
                $imagePath = 'uploads/titles/' . $imageName;
            }

            $title->update([
                'name_1_az' => $request->name_1_az,
                'name_1_en' => $request->name_1_en,
                'name_1_ru' => $request->name_1_ru,
                'name_2_az' => $request->name_2_az,
                'name_2_en' => $request->name_2_en,
                'name_2_ru' => $request->name_2_ru,
                'name_3_az' => $request->name_3_az,
                'name_3_en' => $request->name_3_en,
                'name_3_ru' => $request->name_3_ru,
                'name_4_az' => $request->name_4_az,
                'name_4_en' => $request->name_4_en,
                'name_4_ru' => $request->name_4_ru,
                'name_5_az' => $request->name_5_az,
                'name_5_en' => $request->name_5_en,
                'name_5_ru' => $request->name_5_ru,
                'name_6_az' => $request->name_6_az,
                'name_6_en' => $request->name_6_en,
                'name_6_ru' => $request->name_6_ru,
                'image' => $request->hasFile('image') ? $imagePath : $title->image
            ]);

            toastr()->success('Başlık uğurla yeniləndi');
            return redirect()->route('admin.home.title.index');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $title = HomeTitle::findOrFail($id);

            if ($title->image && File::exists(public_path($title->image))) {
                File::delete(public_path($title->image));
            }

            $title->delete();

            toastr()->success('Başlık uğurla silindi');
            return redirect()->route('admin.home.title.index');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function status($id)
    {
        $title = HomeTitle::findOrFail($id);
        $title->status = !$title->status;
        $title->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi!'
        ]);
    }
}
