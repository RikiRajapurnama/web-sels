<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Benefit;
use App\Models\Lead;
use App\Models\OrderStep;
use App\Models\Package;
use App\Models\Promo;
use App\Models\SalesProfile;
use App\Models\ServiceArea;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sales = SalesProfile::get();

        return view('home', [
            'sales' => $sales,
            'settings' => [
                'site_name' => site_setting('site_name', 'XL SATU WiFi'),
                'site_logo' => site_setting('site_logo'),
                'site_title' => site_setting('site_title', 'XL SATU WiFi — Internet Cepat dan Stabil'),
                'meta_description' => site_setting('meta_description', 'XL SATU WiFi hadir untuk koneksi cepat, stabil dan terjangkau untuk rumah, kerja, belajar, dan hiburan.'),
                'footer_text' => site_setting('footer_text', 'XL SATU WiFi'),
                'copyright' => site_setting('copyright', '© ' . date('Y') . ' XL SATU WiFi'),
                'primary_color' => site_setting('primary_color', '#2563eb'),
            ],
            'banners' => Banner::where('status', true)->orderBy('sort_order')->get(),
            'promos' => Promo::where('status', true)->orderBy('sort_order')->get(),
            'packages' => Package::where('status', true)->orderBy('sort_order')->get(),
            'benefits' => Benefit::where('status', true)->orderBy('sort_order')->get(),
            'steps' => OrderStep::where('status', true)->orderBy('sort_order')->get(),
            'areas' => ServiceArea::where('status', true)->orderBy('sort_order')->get(),
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

        Lead::create([
            'name' => $validated['name'],
            'whatsapp' => $validated['whatsapp'],
            'address' => $validated['address'],
            'package' => $validated['package'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => 'baru',
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Data Anda telah kami terima dan akan segera kami hubungi.');
    }
}
