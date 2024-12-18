<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HumanContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HumanContentController extends Controller
{
    public function index()
    {
        $humanContents = HumanContent::all();
        return view('back.human-content.index', compact('humanContents'));
    }

    public function create()
    {
        return view('back.human-content.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/human-content'), $image);
        }

        HumanContent::create([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'image' => $image ?? null,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.human-content.index')
            ->with('success', 'Məlumat uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $humanContent = HumanContent::findOrFail($id);
        return view('back.human-content.edit', compact('humanContent'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $humanContent = HumanContent::findOrFail($id);

        if ($request->hasFile('image')) {
            // Köhnə şəkili sil
            if ($humanContent->image && File::exists(public_path('uploads/human-content/' . $humanContent->image))) {
                File::delete(public_path('uploads/human-content/' . $humanContent->image));
            }

            // Yeni şəkili yüklə
            $file = $request->file('image');
            $image = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/human-content'), $image);
        }

        $humanContent->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'image' => $image ?? $humanContent->image,
            'status' => $request->status ?? $humanContent->status
        ]);

        return redirect()
            ->route('admin.human-content.index')
            ->with('success', 'Məlumat uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $humanContent = HumanContent::findOrFail($id);
        
        // Şəkili sil
        if ($humanContent->image && File::exists(public_path('uploads/human-content/' . $humanContent->image))) {
            File::delete(public_path('uploads/human-content/' . $humanContent->image));
        }

        $humanContent->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi'
        ]);
    }

    public function status($id)
    {
        $humanContent = HumanContent::findOrFail($id);
        $humanContent->status = !$humanContent->status;
        $humanContent->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}