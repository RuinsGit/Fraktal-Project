<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('back.home.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('back.home.partners.create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/partners'), $imageName);
        }

        Partner::create([
            'image' => $imageName ?? null,
            'link' => $request->link,
            'status' => 1
        ]);

        return redirect()->route('admin.home.partners.index')
            ->with('success', 'Partner uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('back.home.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($partner->image && File::exists(public_path('uploads/partners/' . $partner->image))) {
                File::delete(public_path('uploads/partners/' . $partner->image));
            }

            // Yeni resmi yükle
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/partners'), $imageName);
            $data['image'] = $imageName;
        }

        $partner->update($data);

        return redirect()->route('admin.home.partners.index')
            ->with('success', 'Partner uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        
        // Resmi sil
        if ($partner->image && File::exists(public_path('uploads/partners/' . $partner->image))) {
            File::delete(public_path('uploads/partners/' . $partner->image));
        }

        $partner->delete();

        return redirect()->route('admin.home.partners.index')
            ->with('success', 'Partner uğurla silindi');
    }

    public function status($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->status = !$partner->status;
        $partner->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
            'newStatus' => $partner->status
        ]);
    }
}