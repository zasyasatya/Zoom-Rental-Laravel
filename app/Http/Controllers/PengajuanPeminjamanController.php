<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Zoom;
use Illuminate\Support\Facades\Auth;

class PengajuanPeminjamanController extends Controller
{
     public function index()
    {
        $id_user = Auth::user()->id;
        $peminjaman = peminjaman::where('user_id', $id_user)->get();
        $jml_pinjam = peminjaman::where('user_id', $id_user)->count();
        return view('home.pages.pengajuan.index', [
            'id_page' => 'pengajuan',
            'peminjaman' => $peminjaman,
            'jml_pinjam' => $jml_pinjam,
        ]);
    }

    public function create()
    {
        $akun_zoom = Zoom::where('zooms.status', '=', 'kosong')->get(['zooms.id', 'zooms.nama_akun']);
        return view('home.pages.pengajuan.create', [
            'id_page' => 'pengajuan',
            'akun_zoom' => $akun_zoom,
        ]);
    }

    public function store(Request $request)
    {
        
        $validateData = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'tanggal' => 'required',
            'jam' => 'required', 
            'akun_zoom' => 'required|integer',
            'durasi' => 'required|integer'
        ]);
       
        if ($validateData == FALSE) {
            return redirect('peminjaman.index')
                ->withErrors($validateData)
                ->withInput();
        }

        $id_user = auth()->user()->id;

        $pinjam = new Peminjaman();
        $pinjam->nama_kegiatan = $request->nama_kegiatan;
        $pinjam->deskripsi = $request->deskripsi;
        $pinjam->tanggal = $request->tanggal;
        $pinjam->jam = $request->jam;
        // $pinjam->status_request = NULL;
        $pinjam->zoom_id = $request->akun_zoom;
        $pinjam->alasan_penolakan = '';
        $pinjam->status_request = 'diproses';
        $pinjam->durasi = $request->durasi;
        $pinjam->user_id = $id_user;
        $pinjam->save();

        return redirect()->route('pengajuan.index');
    }


    public function destroy($id)
    {
        $pinjam = Peminjaman::find($id);
        $pinjam->delete();

        return redirect()->route('pengajuan.index');
    }

    public function done(Request $request)
    {
        $pinjam = Zoom::find($request->id);
        $pinjam->status = 'kosong';
        $pinjam->save();
        
        return redirect()->route('pengajuan.index');
    }
}
