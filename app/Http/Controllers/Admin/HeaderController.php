<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HeaderController extends Controller
{
    public function index()
    {
        $headers = Header::all();
        return view('back.home.header.index', compact('headers'));
    }

    public function create()
    {
        return view('back.home.header.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $header = new Header();
            
            // AZ dili için alanlar
            $header->home_az = $request->home_az;
            $header->about_az = $request->about_az;
            $header->vision_az = $request->vision_az;
            $header->history_az = $request->history_az;
            $header->leadership_az = $request->leadership_az;
            $header->services_az = $request->services_az;
            $header->our_services_az = $request->our_services_az;
            $header->courses_az = $request->courses_az;
            $header->study_program_az = $request->study_program_az;
            $header->digital_psychology_az = $request->digital_psychology_az;
            $header->human_design_az = $request->human_design_az;
            $header->media_az = $request->media_az;
            $header->gallery_az = $request->gallery_az;
            $header->blogs_az = $request->blogs_az;
            $header->contact_az = $request->contact_az;

            // EN dili için alanlar
            $header->home_en = $request->home_en;
            $header->about_en = $request->about_en;
            $header->vision_en = $request->vision_en;
            $header->history_en = $request->history_en;
            $header->leadership_en = $request->leadership_en;
            $header->services_en = $request->services_en;
            $header->our_services_en = $request->our_services_en;
            $header->courses_en = $request->courses_en;
            $header->study_program_en = $request->study_program_en;
            $header->digital_psychology_en = $request->digital_psychology_en;
            $header->human_design_en = $request->human_design_en;
            $header->media_en = $request->media_en;
            $header->gallery_en = $request->gallery_en;
            $header->blogs_en = $request->blogs_en;
            $header->contact_en = $request->contact_en;

            // RU dili için alanlar
            $header->home_ru = $request->home_ru;
            $header->about_ru = $request->about_ru;
            $header->vision_ru = $request->vision_ru;
            $header->history_ru = $request->history_ru;
            $header->leadership_ru = $request->leadership_ru;
            $header->services_ru = $request->services_ru;
            $header->our_services_ru = $request->our_services_ru;
            $header->courses_ru = $request->courses_ru;
            $header->study_program_ru = $request->study_program_ru;
            $header->digital_psychology_ru = $request->digital_psychology_ru;
            $header->human_design_ru = $request->human_design_ru;
            $header->media_ru = $request->media_ru;
            $header->gallery_ru = $request->gallery_ru;
            $header->blogs_ru = $request->blogs_ru;
            $header->contact_ru = $request->contact_ru;

            // Resim yükleme işlemi
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/headers', 'public');
                $header->image = $imagePath;
            }

            $header->save();

            return redirect()
                ->route('admin.home.header.index')
                ->with('success', 'Header başarıyla oluşturuldu');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $header = Header::findOrFail($id);
        return view('back.home.header.edit', compact('header'));
    }

    public function update(Request $request, $id)
    {
        try {
            $header = Header::findOrFail($id);
            if ($request->hasFile('image')) {
                // Eski ana resmi sil
                if ($header->image && File::exists(public_path($header->image))) {
                    File::delete(public_path($header->image));
                }

                $mainImage = $request->file('image');
                $destinationPath = public_path('uploads/headers');
                $originalFileName = pathinfo($mainImage->getClientOriginalName(), PATHINFO_FILENAME);
                $mainImageName = time() . '_header_' . $originalFileName . '.webp';

                $imageResource = imagecreatefromstring(file_get_contents($mainImage));
                $webpPath = $destinationPath . '/' . $mainImageName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $header->image = 'uploads/headers/' . $mainImageName;
                }
            }

            // Diğer alanları güncelle
            $header->home_az = $request->home_az;
            $header->about_az = $request->about_az;
            $header->vision_az = $request->vision_az;
            $header->history_az = $request->history_az;
            $header->leadership_az = $request->leadership_az;
            $header->services_az = $request->services_az;
            $header->our_services_az = $request->our_services_az;
            $header->courses_az = $request->courses_az;
            $header->study_program_az = $request->study_program_az;
            $header->digital_psychology_az = $request->digital_psychology_az;
            $header->human_design_az = $request->human_design_az;
            $header->media_az = $request->media_az;
            $header->gallery_az = $request->gallery_az;
            $header->blogs_az = $request->blogs_az;
            $header->contact_az = $request->contact_az;

            // EN dili için alanlar
            $header->home_en = $request->home_en;
            $header->about_en = $request->about_en;
            $header->vision_en = $request->vision_en;
            $header->history_en = $request->history_en;
            $header->leadership_en = $request->leadership_en;
            $header->services_en = $request->services_en;
            $header->our_services_en = $request->our_services_en;
            $header->courses_en = $request->courses_en;
            $header->study_program_en = $request->study_program_en;
            $header->digital_psychology_en = $request->digital_psychology_en;
            $header->human_design_en = $request->human_design_en;
            $header->media_en = $request->media_en;
            $header->gallery_en = $request->gallery_en;
            $header->blogs_en = $request->blogs_en;
            $header->contact_en = $request->contact_en;

            // RU dili için alanlar
            $header->home_ru = $request->home_ru;
            $header->about_ru = $request->about_ru;
            $header->vision_ru = $request->vision_ru;
            $header->history_ru = $request->history_ru;
            $header->leadership_ru = $request->leadership_ru;
            $header->services_ru = $request->services_ru;
            $header->our_services_ru = $request->our_services_ru;
            $header->courses_ru = $request->courses_ru;
            $header->study_program_ru = $request->study_program_ru;
            $header->digital_psychology_ru = $request->digital_psychology_ru;
            $header->human_design_ru = $request->human_design_ru;
            $header->media_ru = $request->media_ru;
            $header->gallery_ru = $request->gallery_ru;
            $header->blogs_ru = $request->blogs_ru;
            $header->contact_ru = $request->contact_ru;

            $header->save();

            return redirect()
                ->route('admin.home.header.index')
                ->with('success', 'Header başarıyla güncellendi');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $header = Header::findOrFail($id);
        
        if ($header->image && file_exists(public_path($header->image))) {
            unlink(public_path($header->image));
        }
        
        $header->delete();

        return redirect()->route('admin.home.header.index')->with('success', 'Header başarıyla silindi');
    }
}