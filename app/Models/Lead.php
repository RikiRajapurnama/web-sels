<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    const STATUS = [
        'baru' => 'Baru',
        'dihubungi' => 'Dihubungi',
        'diproses' => 'Diproses',
        'survey' => 'Survey',
        'pemasangan' => 'Pemasangan',
        'selesai' => 'Selesai',
        'ditolak' => 'Ditolak',
    ];

    protected $fillable = [
        'name',
        'whatsapp',
        'address',
        'package',
        'notes',
        'status',
    ];
}
