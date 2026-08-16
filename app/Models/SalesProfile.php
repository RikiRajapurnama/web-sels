<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'photo',
        'description',
        'whatsapp',
        'phone',
        'email',
        'operational_hours',
    ];

    public static function get(): self
    {
        try {
            return static::firstOrCreate([
                'id' => 1,
            ], [
                'name' => 'Riki Raja Purnama',
                'title' => 'Sales XL SATU WiFi',
                'description' => 'Saya siap membantu Anda mendapatkan paket internet XL SATU yang sesuai dengan kebutuhan rumah, keluarga maupun usaha.',
                'whatsapp' => '0831-7752-2021',
                'operational_hours' => 'Senin - Minggu, 08.00 - 21.00 WIB',
            ]);
        } catch (\Throwable $e) {
            $profile = new static;
            $profile->forceFill(\App\Support\SiteData::defaultSalesData());

            return $profile;
        }
    }

    public function waNumber(): string
    {
        $number = preg_replace('/[^0-9]/', '', (string) $this->whatsapp);

        if (str_starts_with($number, '62')) {
            return $number;
        }

        if (str_starts_with($number, '0')) {
            return '62' . substr($number, 1);
        }

        if (str_starts_with($number, '8')) {
            return '62' . $number;
        }

        return $number;
    }

    public function waLink(string $message = ''): string
    {
        $url = 'https://wa.me/' . $this->waNumber();
        if ($message !== '') {
            $url .= '?text=' . rawurlencode($message);
        }
        return $url;
    }
}
