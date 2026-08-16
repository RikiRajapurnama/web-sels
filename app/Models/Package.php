<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'speed',
        'price',
        'period',
        'description',
        'label',
        'is_popular',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_popular' => 'boolean',
            'status' => 'boolean',
            'price' => 'decimal:2',
        ];
    }
}
