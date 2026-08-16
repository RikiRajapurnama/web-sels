<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Benefit;
use App\Models\OrderStep;
use App\Models\Package;
use App\Models\Promo;
use App\Models\SalesProfile;
use App\Models\ServiceArea;
use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        SalesProfile::updateOrCreate(['id' => 1], [
            'name' => 'Riki Raja Purnama',
            'title' => 'Sales XL SATU WiFi',
            'photo' => null,
            'description' => 'Saya siap membantu Anda mendapatkan paket internet XL SATU yang sesuai dengan kebutuhan rumah, keluarga maupun usaha.',
            'whatsapp' => '0831-7752-2021',
            'phone' => '083177522021',
            'email' => 'sales@xlsatuwifi.id',
            'operational_hours' => 'Senin - Minggu, 08.00 - 21.00 WIB',
        ]);

        $settings = [
            ['site_name', 'XL SATU WiFi', 'website'],
            ['site_title', 'XL SATU WiFi — Internet Cepat dan Stabil', 'website'],
            ['meta_description', 'XL SATU WiFi hadir untuk koneksi cepat, stabil dan terjangkau untuk rumah, kerja, belajar, dan hiburan. Hubungi Sales Riki Raja Purnama.', 'website'],
            ['footer_text', 'XL SATU WiFi', 'website'],
            ['copyright', '© ' . date('Y') . ' XL SATU WiFi', 'website'],
            ['primary_color', '#2563eb', 'website'],
            ['social_facebook', '', 'website'],
            ['social_instagram', '', 'website'],
            ['social_twitter', '', 'website'],
            ['social_tiktok', '', 'website'],
            ['whatsapp_message', 'Hallo Kak Riki, saya ingin bertanya tentang paket XL SATU WiFi. Mohon infonya ya.', 'contact'],
        ];

        foreach ($settings as [$key, $value, $group]) {
            WebsiteSetting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }

        $promos = [
            [
                'title' => 'Bayar 4 Bulan Langsung, Lebih Untung!',
                'subtitle' => 'Promo terbatas untuk pelanggan baru',
                'description' => 'Bayar 4 bulan sekaligus dan nikmati internet XL SATU WiFi dengan harga spesial. Promo berlaku untuk semua area layanan.',
                'price' => 650000,
                'period' => '4 Bulan',
                'bonus' => "Vidio Lite\nCatchplay+\n3 Bulan",
                'sort_order' => 1,
            ],
        ];

        foreach ($promos as $data) {
            Promo::updateOrCreate(['title' => $data['title']], $data);
        }

        $packages = [
            [
                'name' => '250 Mbps',
                'speed' => '250',
                'price' => 229000,
                'period' => 'bulan',
                'description' => 'Koneksi cepat untuk streaming, gaming dan browsing lancar tanpa buffering.',
                'label' => null,
                'is_popular' => false,
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
                'sort_order' => 3,
            ],
        ];

        foreach ($packages as $data) {
            Package::updateOrCreate(['name' => $data['name']], $data);
        }

        $banners = [
            [
                'title' => 'Internet Stabil, Hidup Makin Lancar!',
                'subtitle' => 'XL SATU WiFi hadir untuk koneksi cepat, stabil dan terjangkau untuk rumah, kerja, belajar, dan hiburan.',
                'button_text' => 'Chat WhatsApp',
                'button_link' => '',
                'sort_order' => 1,
            ],
        ];

        foreach ($banners as $data) {
            Banner::updateOrCreate(['title' => $data['title']], $data);
        }

        $benefits = [
            ['icon' => 'bolt', 'title' => 'Kecepatan Konsisten', 'description' => 'Kecepatan tinggi yang stabil sepanjang hari untuk semua aktivitas online Anda.', 'sort_order' => 1],
            ['icon' => 'home', 'title' => 'Koneksi Kuat di Seluruh Rumah', 'description' => 'Sinyal kuat dan merata di setiap sudut rumah Anda.', 'sort_order' => 2],
            ['icon' => 'infinity', 'title' => 'Koneksi Internet Tanpa Batas', 'description' => 'Nikmati internet tanpa khawatir kuota habis.', 'sort_order' => 3],
            ['icon' => 'shield', 'title' => 'Pasti Terpercaya', 'description' => 'Layanan dari provider terpercaya dengan dukungan pelanggan siap membantu.', 'sort_order' => 4],
            ['icon' => 'wallet', 'title' => 'Harga Terjangkau', 'description' => 'Paket dengan harga bersahabat untuk kebutuhan rumah tangga.', 'sort_order' => 5],
        ];

        foreach ($benefits as $data) {
            Benefit::updateOrCreate(['title' => $data['title']], $data);
        }

        $steps = [
            ['step_number' => 1, 'icon' => 'chat', 'title' => 'Hubungi Saya', 'description' => 'Chat WhatsApp untuk konsultasi paket yang sesuai kebutuhan Anda.', 'sort_order' => 1],
            ['step_number' => 2, 'icon' => 'package', 'title' => 'Pilih Paket', 'description' => 'Tentukan paket XL SATU WiFi yang paling cocok untuk rumah Anda.', 'sort_order' => 2],
            ['step_number' => 3, 'icon' => 'wrench', 'title' => 'Konfirmasi & Pemasangan', 'description' => 'Konfirmasi data, tim kami datang untuk pemasangan.', 'sort_order' => 3],
            ['step_number' => 4, 'icon' => 'wifi', 'title' => 'Nikmati Internet', 'description' => 'Internet cepat dan stabil siap menemani aktivitas Anda.', 'sort_order' => 4],
        ];

        foreach ($steps as $data) {
            OrderStep::updateOrCreate(['step_number' => $data['step_number']], $data);
        }

        $areas = [
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

        foreach ($areas as $i => $area) {
            ServiceArea::updateOrCreate(['name' => $area], [
                'city' => null,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
