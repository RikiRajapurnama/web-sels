<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Support\SiteData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'sales' => SiteData::salesProfile(),
            'settings' => SiteData::settings(),
            'banners' => SiteData::banners(),
            'promos' => SiteData::promos(),
            'packages' => SiteData::packages(),
            'benefits' => SiteData::benefits(),
            'steps' => SiteData::steps(),
            'areas' => SiteData::areas(),
        ]);
    }

    public function storeLead(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:30',
            'address' => 'required|string|max:500',
            'package' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            Lead::create([
                'name' => $validated['name'],
                'whatsapp' => $validated['whatsapp'],
                'address' => $validated['address'],
                'package' => $validated['package'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'status' => 'baru',
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['database' => 'Pendaftaran sedang tidak dapat diproses saat ini. Silakan hubungi kami langsung melalui WhatsApp.']);
        }

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Data Anda telah kami terima dan akan segera kami hubungi.');
    }
}
