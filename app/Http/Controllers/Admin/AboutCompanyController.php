<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class AboutCompanyController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $aboutCompany = AboutCompany::first();
        return view('back.about.company.index', compact('aboutCompany'));
    }

    public function create()
    {
        if (AboutCompany::count() > 0) {
            return redirect()->route('admin.about.company.index')
                ->with('error', 'Yalnız bir şirkət məlumatı əlavə edilə bilər!');
        }
        return view('back.about.company.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about'), $imageName);
                $data['image'] = 'uploads/about/' . $imageName;
            }

            AboutCompany::create($data);

            return redirect()
                ->route('admin.about.company.index')
                ->with('success', 'Məlumat uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $aboutCompany = AboutCompany::findOrFail($id);
        return view('back.about.company.edit', compact('aboutCompany'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        try {
            $aboutCompany = AboutCompany::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('image')) {
                // Eski resmi sil
                if ($aboutCompany->image && File::exists(public_path($aboutCompany->image))) {
                    File::delete(public_path($aboutCompany->image));
                }

                $file = $request->file('image');
                $destinationPath = public_path('uploads/about');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                // Klasörün var olduğundan emin ol
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $data['image'] = 'uploads/about/' . $webpFileName;
                }
            }

            $aboutCompany->update($data);

            return redirect()
                ->route('admin.about.company.index')
                ->with('success', 'Məlumat uğurla yeniləndi');

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
            $aboutCompany = AboutCompany::findOrFail($id);

            if ($aboutCompany->image && File::exists(public_path($aboutCompany->image))) {
                File::delete(public_path($aboutCompany->image));
            }

            $aboutCompany->delete();

            return redirect()
                ->route('admin.about.company.index')
                ->with('success', 'Məlumat uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        $aboutCompany = AboutCompany::findOrFail($id);
        $aboutCompany->status = !$aboutCompany->status;
        $aboutCompany->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
            'newStatus' => $aboutCompany->status
        ]);
    }
}