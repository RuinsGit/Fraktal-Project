<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactTitle;
use Illuminate\Http\Request;

class ContactTitleController extends Controller
{
    public function index()
    {
        $contactTitles = ContactTitle::all();
        return view('back.contact-title.index', compact('contactTitles'));
    }

    public function create()
    {
        return view('back.contact-title.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
        ]);

        ContactTitle::create([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.contact-title.index')
            ->with('success', 'Başlıq uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $contactTitle = ContactTitle::findOrFail($id);
        return view('back.contact-title.edit', compact('contactTitle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
        ]);

        $contactTitle = ContactTitle::findOrFail($id);
        
        $contactTitle->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'status' => $request->status ?? $contactTitle->status
        ]);

        return redirect()
            ->route('admin.contact-title.index')
            ->with('success', 'Başlıq uğurla yeniləndi');
    }

    public function destroy($id)
    {
        ContactTitle::findOrFail($id)->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Başlıq uğurla silindi'
        ]);
    }

    public function status($id)
    {
        $contactTitle = ContactTitle::findOrFail($id);
        $contactTitle->status = !$contactTitle->status;
        $contactTitle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
