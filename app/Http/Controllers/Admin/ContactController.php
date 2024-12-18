<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::firstOrNew();
        return view('back.pages.contact', compact('contact'));
    }

    public function update(Request $request)
    {
        try {
            $contact = Contact::firstOrNew();

            if ($request->hasFile('logo')) {
                if ($contact->logo && File::exists(public_path($contact->logo))) {
                    File::delete(public_path($contact->logo));
                }

                $file = $request->file('logo');
                $destinationPath = public_path('uploads/contact');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_logo_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $contact->logo = 'uploads/contact/' . $webpFileName;
                }
            }

            if ($request->hasFile('logo_2')) {
                if ($contact->logo_2 && File::exists(public_path($contact->logo_2))) {
                    File::delete(public_path($contact->logo_2));
                }

                $file = $request->file('logo_2');
                $destinationPath = public_path('uploads/contact');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_logo2_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $contact->logo_2 = 'uploads/contact/' . $webpFileName;
                }
            }

            if ($request->hasFile('favicon')) {
                if ($contact->favicon && File::exists(public_path($contact->favicon))) {
                    File::delete(public_path($contact->favicon));
                }

                $file = $request->file('favicon');
                $destinationPath = public_path('uploads/contact');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_favicon_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $contact->favicon = 'uploads/contact/' . $webpFileName;
                }
            }

            $contact->fill($request->only([
                'email',
                'phone',
                'address_az',
                'address_en',
                'address_ru',
                'work_hours_az',
                'work_hours_en',
                'work_hours_ru',
                'facebook',
                'instagram',
                'youtube'
            ]));

            $contact->save();

            return redirect()
                ->route('admin.contact')
                ->with('success', 'Məlumatlar uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }
}
