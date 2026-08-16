<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesProfile;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit()
    {
        return view('admin.contact.edit', [
            'profile' => SalesProfile::get(),
            'whatsappMessage' => site_setting('whatsapp_message', 'Hallo Kak Riki, saya ingin bertanya tentang paket XL SATU WiFi. Mohon infonya ya.'),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'whatsapp' => 'required|string|max:30',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'operational_hours' => 'nullable|string|max:255',
            'whatsapp_message' => 'nullable|string|max:1000',
        ]);

        $profile = SalesProfile::get();
        $profile->update([
            'whatsapp' => $data['whatsapp'],
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'operational_hours' => $data['operational_hours'] ?? null,
        ]);

        WebsiteSetting::updateOrCreate(['key' => 'whatsapp_message'], [
            'value' => $data['whatsapp_message'] ?? '',
            'group' => 'contact',
        ]);

        return redirect()->route('admin.contact.edit')->with('success', 'Kontak berhasil diperbarui. Semua tombol WhatsApp di website Customer otomatis menggunakan nomor baru.');
    }
}
