<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('back.pages.profile', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path('uploads/users/' . $user->image))) {
                unlink(public_path('uploads/users/' . $user->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/users'), $imageName);
            $user->image = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Cari şifrə yanlışdır']);
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil məlumatları uğurla yeniləndi.');
    }
}
