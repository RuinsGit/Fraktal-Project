<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->get();
        return view('back.home.company.index', compact('companies'));
    }

    public function create()
    {
        return view('back.home.company.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_1_az' => 'required|string|max:255',
                'name_1_en' => 'required|string|max:255',
                'name_1_ru' => 'required|string|max:255',
                'name_2_az' => 'required|string|max:255',
                'name_2_en' => 'required|string|max:255',
                'name_2_ru' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('uploads/companies');
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

                    $imagePath = 'uploads/companies/' . $webpFileName;
                }
            }

            Company::create([
                'name_1_az' => $request->name_1_az,
                'name_1_en' => $request->name_1_en,
                'name_1_ru' => $request->name_1_ru,
                'name_2_az' => $request->name_2_az,
                'name_2_en' => $request->name_2_en,
                'name_2_ru' => $request->name_2_ru,
                'image' => $imagePath ?? null,
                'status' => $request->status ? 1 : 0
            ]);

            toastr()->success('Şirkət uğurla əlavə edildi!');
            return redirect()->route('admin.home.company.index');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('back.home.company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        try {
            $company = Company::findOrFail($id);

            $validated = $request->validate([
                'name_1_az' => 'required|string|max:255',
                'name_1_en' => 'required|string|max:255',
                'name_1_ru' => 'required|string|max:255',
                'name_2_az' => 'required|string|max:255',
                'name_2_en' => 'required|string|max:255',
                'name_2_ru' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                if ($company->image && File::exists(public_path($company->image))) {
                    File::delete(public_path($company->image));
                }

                $file = $request->file('image');
                $destinationPath = public_path('uploads/companies');
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

                    $imagePath = 'uploads/companies/' . $webpFileName;
                }
            }

            $company->update([
                'name_1_az' => $request->name_1_az,
                'name_1_en' => $request->name_1_en,
                'name_1_ru' => $request->name_1_ru,
                'name_2_az' => $request->name_2_az,
                'name_2_en' => $request->name_2_en,
                'name_2_ru' => $request->name_2_ru,
                'image' => $request->hasFile('image') ? $imagePath : $company->image,
                'status' => $request->status ? 1 : 0
            ]);

            toastr()->success('Şirkət uğurla yeniləndi!');
            return redirect()->route('admin.home.company.index');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $company = Company::findOrFail($id);

            if ($company->image && File::exists(public_path($company->image))) {
                File::delete(public_path($company->image));
            }

            $company->delete();

            toastr()->success('Şirkət uğurla silindi!');
            return redirect()->route('admin.home.company.index');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function status($id)
    {
        $company = Company::findOrFail($id);
        $company->status = !$company->status;
        $company->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi!'
        ]);
    }
}
