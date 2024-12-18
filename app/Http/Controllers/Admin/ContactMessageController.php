<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('back.pages.contact-message', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('back.pages.contact-message-detail', compact('message'));
    }

    public function destroy($id)
    {
        try {
            ContactMessage::findOrFail($id)->delete();
            return redirect()
                ->route('admin.contact-message.index')
                ->with('success', 'Müraciət uğurla silindi!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi!');
        }
    }

    public function markAsRead($id)
    {
        try {
            ContactMessage::findOrFail($id)->update(['status' => true]);
            return redirect()
                ->back()
                ->with('success', 'Müraciət oxundu olaraq işarələndi!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi!');
        }
    }
}