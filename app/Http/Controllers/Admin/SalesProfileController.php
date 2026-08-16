<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\UploadsImages;
use App\Models\SalesProfile;
use Illuminate\Http\Request;

class SalesProfileController extends Controller
{
    use UploadsImages;

    public function edit()
    {
        return view('admin.sales_profile.edit', [
            'profile' => SalesProfile::get(),
        ]);
    }

    public function update(Request $request)
    {
        $profile = SalesProfile::get();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'description' => 'nullable|string',
            'whatsapp' => 'required|string|max:30',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'operational_hours' => 'nullable|string|max:255',
        ]);

        $data['photo'] = $this->storeImage($request->file('photo'), 'uploads/profile', $profile->photo);

        $profile->update($data);

        return redirect()->route('admin.sales-profile.edit')->with('success', 'Profil Sales berhasil diperbarui.');
    }
}
