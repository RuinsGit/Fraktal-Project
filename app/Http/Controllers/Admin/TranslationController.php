<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TranslationController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $translations = Translation::all();
        return view('admin.translations.index', compact('translations'));
    }

    public function create()
    {
        return view('admin.translations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:translations,key',
            'value_az' => 'required',
        ]);

        Translation::create($request->all());

        return redirect()->route('admin.translations.index')->with('success', 'Translation created successfully.');
    }

    public function edit(Translation $translation)
    {
        return view('admin.translations.edit', compact('translation'));
    }

    public function update(Request $request, Translation $translation)
    {
        $request->validate([
            'key' => 'required|unique:translations,key,' . $translation->id,
            'value_az' => 'required',
        ]);

        $translation->update($request->all());

        return redirect()->route('admin.translations.index')->with('success', 'Translation updated successfully.');
    }

    public function destroy(Translation $translation)
    {
        $translation->delete();

        return redirect()->route('admin.translations.index')->with('success', 'Translation deleted successfully.');
    }
}