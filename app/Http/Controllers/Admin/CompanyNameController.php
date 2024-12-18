<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyNameController extends Controller
{
    public function index()
    {
        $companyNames = CompanyName::all();
        return view('back.home.company-names.index', compact('companyNames'));
    }

    public function create()
    {
        if (CompanyName::count() > 0) {
            return redirect()->route('admin.home.company-names.index')
                ->with('error', 'Yalnız bir şirkət adı məlumatı əlavə edilə bilər!');
        }
        return view('back.home.company-names.create');
    }

    public function store(Request $request)
    {
        if (CompanyName::count() > 0) {
            return redirect()->route('admin.home.company-names.index')
                ->with('error', 'Yalnız bir şirkət adı məlumatı əlavə edilə bilər!');
        }

        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'required|string',
            'text_ru' => 'required|string',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('uploads/company-names');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $data['image'] = 'uploads/company-names/' . $webpFileName;
                }
            }

            CompanyName::create($data);

            return redirect()->route('admin.home.company-names.index')
                ->with('success', 'Şirkət adı uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $companyName = CompanyName::findOrFail($id);
        return view('back.home.company-names.edit', compact('companyName'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'required|string',
            'text_ru' => 'required|string',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $companyName = CompanyName::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('image')) {
                if ($companyName->image && File::exists(public_path($companyName->image))) {
                    File::delete(public_path($companyName->image));
                }

                $file = $request->file('image');
                $destinationPath = public_path('uploads/company-names');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $data['image'] = 'uploads/company-names/' . $webpFileName;
                }
            }

            $companyName->update($data);

            return redirect()->route('admin.home.company-names.index')
                ->with('success', 'Şirkət adı uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $companyName = CompanyName::findOrFail($id);
        $companyName->delete();

        return redirect()->route('admin.home.company-names.index')
            ->with('success', 'Şirkət adı uğurla silindi');
    }

    public function status($id)
    {
        $companyName = CompanyName::findOrFail($id);
        $companyName->status = !$companyName->status;
        $companyName->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
            'newStatus' => $companyName->status
        ]);
    }
}
