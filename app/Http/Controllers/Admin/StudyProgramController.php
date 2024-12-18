<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudyProgramController extends Controller
{
    public function index()
    {
        $programs = StudyProgram::all();
        return view('back.home.study-programs.index', compact('programs'));
    }

    public function create()
    {
        if(StudyProgram::count() > 0) {
            return redirect()->route('admin.home.study-programs.index')
                ->with('error', 'Yalnız bir təhsil proqramı məlumatı əlavə edilə bilər!');
        }
        return view('back.home.study-programs.create');
    }

    public function store(Request $request)
    {
        if(StudyProgram::count() > 0) {
            return redirect()->route('admin.home.study-programs.index')
                ->with('error', 'Yalnız bir təhsil proqramı məlumatı əlavə edilə bilər!');
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name_az' => 'required|max:255',
            'text_az' => 'required',
            'description_az' => 'required',
            'name_en' => 'required|max:255',
            'text_en' => 'required',
            'description_en' => 'required',
            'name_ru' => 'required|max:255',
            'text_ru' => 'required',
            'description_ru' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path('uploads');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $imagePath = 'uploads/' . $webpFileName;
            }
        }

        StudyProgram::create([
            'name_az' => $request->name_az,
            'text_az' => $request->text_az,
            'description_az' => $request->description_az,
            'name_en' => $request->name_en,
            'text_en' => $request->text_en,
            'description_en' => $request->description_en,
            'name_ru' => $request->name_ru,
            'text_ru' => $request->text_ru,
            'description_ru' => $request->description_ru,
            'image' => $imagePath ?? null,
            'status' => 1
        ]);

        return redirect()->route('admin.home.study-programs.index')
            ->with('success', 'Program uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $program = StudyProgram::findOrFail($id);
        return view('back.home.study-programs.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name_az' => 'required|max:255',
            'text_az' => 'required',
            'description_az' => 'required',
            'name_en' => 'required|max:255',
            'text_en' => 'required',
            'description_en' => 'required',
            'name_ru' => 'required|max:255',
            'text_ru' => 'required',
            'description_ru' => 'required',
        ]);

        $program = StudyProgram::findOrFail($id);

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($program->image && File::exists(public_path($program->image))) {
                File::delete(public_path($program->image));
            }

            $file = $request->file('image');
            $destinationPath = public_path('uploads');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $imagePath = 'uploads/' . $webpFileName;
                $program->image = $imagePath;
            }
        }

        $program->update([
            'name_az' => $request->name_az,
            'text_az' => $request->text_az,
            'description_az' => $request->description_az,
            'name_en' => $request->name_en,
            'text_en' => $request->text_en,
            'description_en' => $request->description_en,
            'name_ru' => $request->name_ru,
            'text_ru' => $request->text_ru,
            'description_ru' => $request->description_ru
        ]);

        return redirect()->route('admin.home.study-programs.index')
            ->with('success', 'Program uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $program = StudyProgram::findOrFail($id);
        
        // Resmi sil
        if ($program->image && File::exists(public_path($program->image))) {
            File::delete(public_path($program->image));
        }
        
        $program->delete();

        return redirect()->route('admin.home.study-programs.index')
            ->with('success', 'Program uğurla silindi');
    }

    public function status($id)
    {
        $program = StudyProgram::findOrFail($id);
        $program->status = !$program->status;
        $program->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
            'newStatus' => $program->status
        ]);
    }
}