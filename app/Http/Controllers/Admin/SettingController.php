<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\UploadsImages;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use UploadsImages;

    public function edit()
    {
        return view('admin.settings.edit', [
            'settings' => [
                'site_name' => site_setting('site_name', 'XL SATU WiFi'),
                'site_title' => site_setting('site_title', 'XL SATU WiFi — Internet Cepat dan Stabil'),
                'meta_description' => site_setting('meta_description', 'XL SATU WiFi hadir untuk koneksi cepat, stabil dan terjangkau.'),
                'site_logo' => site_setting('site_logo'),
                'favicon' => site_setting('favicon'),
                'footer_text' => site_setting('footer_text', 'XL SATU WiFi'),
                'copyright' => site_setting('copyright', '© ' . date('Y') . ' XL SATU WiFi'),
                'primary_color' => site_setting('primary_color', '#2563eb'),
                'facebook' => site_setting('social_facebook'),
                'instagram' => site_setting('social_instagram'),
                'twitter' => site_setting('social_twitter'),
                'tiktok' => site_setting('social_tiktok'),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:4096',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,ico,svg,webp|max:2048',
            'footer_text' => 'nullable|string|max:255',
            'copyright' => 'nullable|string|max:255',
            'primary_color' => 'nullable|string|max:20',
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_tiktok' => 'nullable|url|max:255',
        ]);

        $map = [
            'site_name' => 'site_name',
            'site_title' => 'site_title',
            'meta_description' => 'meta_description',
            'footer_text' => 'footer_text',
            'copyright' => 'copyright',
            'primary_color' => 'primary_color',
            'social_facebook' => 'social_facebook',
            'social_instagram' => 'social_instagram',
            'social_twitter' => 'social_twitter',
            'social_tiktok' => 'social_tiktok',
        ];

        foreach ($map as $input => $key) {
            WebsiteSetting::updateOrCreate(['key' => $key], [
                'value' => $data[$input] ?? '',
                'group' => 'website',
            ]);
        }

        if ($request->hasFile('site_logo')) {
            $old = site_setting('site_logo');
            $logo = $this->storeImage($request->file('site_logo'), 'uploads/settings', $old);
            if ($logo) {
                WebsiteSetting::updateOrCreate(['key' => 'site_logo'], ['value' => $logo, 'group' => 'website']);
            }
        }

        if ($request->hasFile('favicon')) {
            $old = site_setting('favicon');
            $favicon = $this->storeImage($request->file('favicon'), 'uploads/settings', $old);
            if ($favicon) {
                WebsiteSetting::updateOrCreate(['key' => 'favicon'], ['value' => $favicon, 'group' => 'website']);
            }
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
