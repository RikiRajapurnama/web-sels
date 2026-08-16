<?php

namespace App\Support;

use App\Models\Banner;
use App\Models\Benefit;
use App\Models\OrderStep;
use App\Models\Package;
use App\Models\Promo;
use App\Models\SalesProfile;
use App\Models\ServiceArea;
use App\Models\WebsiteSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Resilient access to the website content.
 *
 * When the database is available the real records are used; when it is not
 * (e.g. before an external database is configured on Vercel) a built-in set
 * of default content is returned so the customer website never 500s.
 */
class SiteData
{
    protected static ?bool $databaseAvailable = null;

    /**
     * Check once per process/request whether the default database connection works.
     */
    public static function databaseAvailable(): bool
    {
        if (self::$databaseAvailable !== null) {
            return self::$databaseAvailable;
        }

        try {
            DB::connection()->getPdo();
            self::$databaseAvailable = true;
        } catch (\Throwable) {
            self::$databaseAvailable = false;
        }

        return self::$databaseAvailable;
    }

    public static function salesProfile(): SalesProfile
    {
        if (self::databaseAvailable()) {
            try {
                return SalesProfile::get();
            } catch (\Throwable) {
                self::$databaseAvailable = false;
            }
        }

        $profile = new SalesProfile;
        $profile->forceFill(self::defaultSalesData());

        return $profile;
    }

    public static function settings(): array
    {
        $defaults = self::defaultSettings();

        if (! self::databaseAvailable()) {
            return $defaults;
        }

        try {
            $keys = array_keys($defaults);
            $rows = WebsiteSetting::whereIn('key', $keys)->pluck('value', 'key')->toArray();

            return array_merge($defaults, $rows);
        } catch (\Throwable) {
            self::$databaseAvailable = false;

            return $defaults;
        }
    }

    public static function banners(): Collection
    {
        return self::content(
            fn () => Banner::where('status', true)->orderBy('sort_order')->get(),
            self::defaultBanners()
        );
    }

    public static function promos(): Collection
    {
        return self::content(
            fn () => Promo::where('status', true)->orderBy('sort_order')->get(),
            self::defaultPromos()
        );
    }

    public static function packages(): Collection
    {
        return self::content(
            fn () => Package::where('status', true)->orderBy('sort_order')->get(),
            self::defaultPackages()
        );
    }

    public static function benefits(): Collection
    {
        return self::content(
            fn () => Benefit::where('status', true)->orderBy('sort_order')->get(),
            self::defaultBenefits()
        );
    }

    public static function steps(): Collection
    {
        return self::content(
            fn () => OrderStep::where('status', true)->orderBy('sort_order')->get(),
            self::defaultSteps()
        );
    }

    public static function areas(): Collection
    {
        return self::content(
            fn () => ServiceArea::where('status', true)->orderBy('sort_order')->get(),
            self::defaultAreas()
        );
    }

    /**
     * Run a query when the database is available, otherwise fall back to defaults.
     */
    protected static function content(callable $query, array $fallback): Collection
    {
        if (! self::databaseAvailable()) {
            return collect($fallback);
        }

        try {
            return $query();
        } catch (\Throwable) {
            self::$databaseAvailable = false;

            return collect($fallback);
        }
    }

    public static function defaultSalesData(): array
    {
        return [
            'name' => 'Riki Raja Purnama',
            'title' => 'Sales XL SATU WiFi',
            'photo' => null,
            'description' => 'Saya siap membantu Anda mendapatkan paket internet XL SATU yang sesuai dengan kebutuhan rumah, keluarga maupun usaha.',
            'whatsapp' => '0831-7752-2021',
            'phone' => '083177522021',
            'email' => 'sales@xlsatuwifi.id',
            'operational_hours' => 'Senin - Minggu, 08.00 - 21.00 WIB',
        ];
    }

    public static function defaultSettings(): array
    {
        return [
            'site_name' => 'XL SATU WiFi',
            'site_title' => 'XL SATU WiFi — Internet Cepat dan Stabil',
            'meta_description' => 'XL SATU WiFi hadir untuk koneksi cepat, stabil dan terjangkau untuk rumah, kerja, belajar, dan hiburan. Hubungi Sales Riki Raja Purnama.',
            'footer_text' => 'XL SATU WiFi',
            'copyright' => '© '.date('Y').' XL SATU WiFi',
            'primary_color' => '#2563eb',
            'wa_message' => 'Hallo Kak Riki, saya ingin bertanya tentang paket XL SATU WiFi. Mohon infonya ya.',
            'site_logo' => null,
            'favicon' => null,
            'social_facebook' => null,
            'social_instagram' => null,
            'social_twitter' => null,
            'social_tiktok' => null,
        ];
    }

    protected static function defaultBanners(): array
    {
        $banner = new Banner;
        $banner->forceFill([
            'title' => 'Internet Stabil, Hidup Makin Lancar!',
            'subtitle' => 'XL SATU WiFi hadir untuk koneksi cepat, stabil dan terjangkau untuk rumah, kerja, belajar, dan hiburan.',
            'image' => null,
            'button_text' => 'Chat WhatsApp',
            'button_link' => null,
            'status' => true,
            'sort_order' => 1,
        ]);

        return [$banner];
    }

    protected static function defaultPromos(): array
    {
        $promo = new Promo;
        $promo->forceFill([
            'title' => 'Bayar 4 Bulan Langsung, Lebih Untung!',
            'subtitle' => 'Promo terbatas untuk pelanggan baru',
            'description' => 'Bayar 4 bulan sekaligus dan nikmati internet XL SATU WiFi dengan harga spesial. Promo berlaku untuk semua area layanan.',
            'price' => 650000,
            'period' => '4 Bulan',
            'bonus' => "Vidio Lite\nCatchplay+\n3 Bulan",
            'image' => null,
            'status' => true,
            'sort_order' => 1,
        ]);

        return [$promo];
    }

    protected static function defaultPackages(): array
    {
        $packages = [
            [
                'name' => '250 Mbps',
                'speed' => '250',
                'price' => 229000,
                'period' => 'bulan',
                'description' => 'Koneksi cepat untuk streaming, gaming dan browsing lancar tanpa buffering.',
                'label' => null,
                'is_popular' => false,
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => '350 Mbps',
                'speed' => '350',
                'price' => 279000,
                'period' => 'bulan',
                'description' => 'Paket paling laris. Cocok untuk rumah dengan banyak perangkat aktif sekaligus.',
                'label' => 'BEST SELLER',
                'is_popular' => true,
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => '400 Mbps',
                'speed' => '400',
                'price' => 300000,
                'period' => 'bulan',
                'description' => 'Kecepatan maksimal untuk rumah, kantor dan kebutuhan berat lainnya.',
                'label' => null,
                'is_popular' => false,
                'status' => true,
                'sort_order' => 3,
            ],
        ];

        return array_map(fn (array $data) => (new Package)->forceFill($data), $packages);
    }

    protected static function defaultBenefits(): array
    {
        $benefits = [
            ['icon' => 'bolt', 'title' => 'Kecepatan Konsisten', 'description' => 'Kecepatan tinggi yang stabil sepanjang hari untuk semua aktivitas online Anda.', 'status' => true, 'sort_order' => 1],
            ['icon' => 'home', 'title' => 'Koneksi Kuat di Seluruh Rumah', 'description' => 'Sinyal kuat dan merata di setiap sudut rumah Anda.', 'status' => true, 'sort_order' => 2],
            ['icon' => 'infinity', 'title' => 'Koneksi Internet Tanpa Batas', 'description' => 'Nikmati internet tanpa khawatir kuota habis.', 'status' => true, 'sort_order' => 3],
            ['icon' => 'shield', 'title' => 'Pasti Terpercaya', 'description' => 'Layanan dari provider terpercaya dengan dukungan pelanggan siap membantu.', 'status' => true, 'sort_order' => 4],
            ['icon' => 'wallet', 'title' => 'Harga Terjangkau', 'description' => 'Paket dengan harga bersahabat untuk kebutuhan rumah tangga.', 'status' => true, 'sort_order' => 5],
        ];

        return array_map(fn (array $data) => (new Benefit)->forceFill($data), $benefits);
    }

    protected static function defaultSteps(): array
    {
        $steps = [
            ['step_number' => 1, 'icon' => 'chat', 'title' => 'Hubungi Saya', 'description' => 'Chat WhatsApp untuk konsultasi paket yang sesuai kebutuhan Anda.', 'status' => true, 'sort_order' => 1],
            ['step_number' => 2, 'icon' => 'package', 'title' => 'Pilih Paket', 'description' => 'Tentukan paket XL SATU WiFi yang paling cocok untuk rumah Anda.', 'status' => true, 'sort_order' => 2],
            ['step_number' => 3, 'icon' => 'wrench', 'title' => 'Konfirmasi & Pemasangan', 'description' => 'Konfirmasi data, tim kami datang untuk pemasangan.', 'status' => true, 'sort_order' => 3],
            ['step_number' => 4, 'icon' => 'wifi', 'title' => 'Nikmati Internet', 'description' => 'Internet cepat dan stabil siap menemani aktivitas Anda.', 'status' => true, 'sort_order' => 4],
        ];

        return array_map(fn (array $data) => (new OrderStep)->forceFill($data), $steps);
    }

    protected static function defaultAreas(): array
    {
        $names = [
            'Kota Bandung',
            'Kabupaten Bandung',
            'Cimahi',
            'Soreang',
            'Margahayu',
            'Dayeuhkolot',
            'Cileunyi',
            'Rancaekek',
            'Cicalengka',
            'Area lainnya',
        ];

        return array_map(
            fn (int $i) => (new ServiceArea)->forceFill([
                'name' => $names[$i],
                'city' => null,
                'status' => true,
                'sort_order' => $i + 1,
            ]),
            array_keys($names)
        );
    }
}
