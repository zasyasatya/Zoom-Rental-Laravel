<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    public $table='peminjamans';
    protected $fillable=[
        'zoom_id',
        'nama_kegiatan',
        'deskripsi',
        'tanggal',
        'jam',
        'durasi',
        'room_zoom',
        'status_request',
        'status_peminjaman',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zoom()
    {
        return $this->belongsTo(Zoom::class);
    }
}
