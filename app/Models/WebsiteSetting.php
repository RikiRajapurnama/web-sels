<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    public static function get(string $key, ?string $default = null): ?string
    {
        try {
            $setting = static::where('key', $key)->first();

            return $setting?->value ?? $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }
}
