<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zoom extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'zooms';
    protected $fillable = [
        'nama_akun',
        'kapasitas',
        'status',
    ];

    protected $dates = ['deleted_at'];

    public function peminjaman() {
        return $this->hasOne(Peminjaman::class);
    }
}
