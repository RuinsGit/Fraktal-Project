<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::firstOrNew();
        return view('back.pages.about', compact('about'));
    }

    public function update(Request $request)
    {
        try {
            $about = About::firstOrNew();

            if ($request->hasFile('image')) {
                // Eski resmi sil
                if ($about->image && File::exists(public_path($about->image))) {
                    File::delete(public_path($about->image));
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

                    $about->image = 'uploads/about/' . $webpFileName;
                }
            }

            $about->fill($request->only([
                'title_az',
                'title_en',
                'title_ru',
                'description_az',
                'description_en',
                'description_ru'
            ]));

            $about->save();

            return redirect()
                ->route('admin.about')
                ->with('success', 'Məlumatlar uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }
}
