<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class JadwalController extends Controller
{
     public function index()
    {
        $pinjams = Peminjaman::where('status_request', 'terima')->get();
        $total = $pinjams->count();
        return view('home.pages.jadwal.index', ['id_page' => 'jadwal',
                                                    'pinjams' => $pinjams,
                                                    'total' => $total]);
    }
}
/*$pinjams = Peminjaman::join('zooms', 'peminjamans.zoom_id', '=', 'zooms.id')
                                ->join('users', 'peminjamans.user_id', '=', 'users.id')
                                ->where('zooms.status', '=', 'kosong')
                                ->where('peminjamans.status_request', '=', 'terima')
                                ->get(['peminjamans.*', 'zooms.nama_akun', 'users.name']);*/