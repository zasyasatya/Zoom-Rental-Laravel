<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Zoom;


class PeminjamanController extends Controller
{
    public function index()
    {
        $pinjams = Peminjaman::join('zooms', 'peminjamans.zoom_id', '=', 'zooms.id')
                                ->join('users', 'peminjamans.user_id', '=', 'users.id')
                                ->get(['peminjamans.*', 'zooms.nama_akun','users.name', 'zooms.status']);
        $total = Peminjaman::all()->count();
        return view('home.pages.peminjaman.index', ['id_page' => 'peminjaman',
                                                    'pinjams' => $pinjams,
                                                    'total' => $total]);
    }

    public function edit($id)
    {
        $pinjam = Peminjaman::where('id', $id)->first();
        // $pinjam = Peminjaman::join('zooms', 'peminjamans.zoom_id', '=', 'zooms.id')
        // ->join('users', 'peminjamans.user_id', '=', 'users.id')
        // ->get(['peminjamans.*', 'zooms.nama_akun','users.name', 'zooms.status']);
        // ->where('peminjamans.id', '=', $id);
        // dd($pinjam);
        $nama_akun = Zoom::where('id', $pinjam->id)->first();
        // dd($nama_akun);
        $akun_zoom = Zoom::where('zooms.status', '=', 'kosong')->get(['zooms.id', 'zooms.nama_akun']);
        return view('home.pages.peminjaman.update', ['id_page' => 'peminjaman',
                                                    'pinjam' => $pinjam,
                                                    'nama_akun' => $nama_akun,
                                                    'akun_zoom' => $akun_zoom
                                                ]);
    }

    public function update(Request $request)
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

        $pinjam = Peminjaman::find($request->id);
        $pinjam->nama_kegiatan = $request->nama_kegiatan;
        $pinjam->deskripsi = $request->deskripsi;
        $pinjam->tanggal = $request->tanggal;
        $pinjam->jam = $request->jam;
        // $pinjam->status_request = NULL;
        $pinjam->zoom_id = $request->akun_zoom;
        $pinjam->alasan_penolakan = '';
        $pinjam->status_request = 'diproses';
        $pinjam->save();

        return redirect()->route('peminjaman.index');
    }

    public function destroy($id)
    {
        $pinjam = Peminjaman::find($id);
        $pinjam->delete();

        return redirect()->route('peminjaman.index');
    }

    public function reject(Request $request)
    {
        $validateData = $request->validate([
            'alasan_penolakan' => 'required'
        ]);

        // if ($validateData == FALSE) {
        //     return redirect('peminjaman.index')
        //         ->withErrors($validateData)
        //         ->withInput();
        // }
        $zoom = Zoom::find($request->zoom);
        $zoom->status = 'kosong';
        $zoom->save();
      
        $pinjam = Peminjaman::find($request->id);
        $pinjam->status_request = 'tolak';
        $pinjam->alasan_penolakan = $request->alasan_penolakan;
        $pinjam->room_zoom = '';

        $pinjam->save();

        // $zoom->peminjaman()->whereId($request->id)->update([
        //     'status' => 'kosong'
        // ]);


        return redirect()->route('peminjaman.index');
    }

    public function create()
    {
        // $akun_zoom1 = Peminjaman::join('zooms', 'peminjamans.zoom_id', '=', 'zooms.id')
        //                         ->where('peminjamans.status_peminjaman', '=', 'selesai')
        //                         ->get(['zooms.id', 'zooms.nama_akun']);
        
        // $akun_zoom2 = Peminjaman::rightJoin('zooms', 'peminjamans.zoom_id', '=', 'zooms.id')
        //                         ->where('peminjamans.zoom_id', '=', NULL)
        //                         // ->where('peminjamans.status_peminjaman', '=', 'selesai')
        //                         ->get(['zooms.id', 'zooms.nama_akun']);

         $akun_zoom = Zoom::where('zooms.status', '=', 'kosong')->get(['zooms.id', 'zooms.nama_akun']);
        // dd($akun_zoom);
        return view('home.pages.peminjaman.create', ['id_page' => 'peminjaman',
                                                        'akun_zoom' => $akun_zoom
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

        return redirect()->route('peminjaman.index');
    }


    public function approve(Request $request)
    {
        $validateData = $request->validate([
            'room_zoom' => 'required|string'
        ]);

        if ($validateData == FALSE) {
            return redirect('peminjaman.index')
                ->withErrors($validateData)
                ->withInput();
        }

        $pinjam = Peminjaman::find($request->id);
        $pinjam->status_request = 'terima';
        $pinjam->room_zoom = $request->room_zoom;
        $pinjam->alasan_penolakan = '';

        $pinjam->save();

        $zoom = Zoom::find($request->zoom);
        $zoom->status = 'dipinjam';
        $zoom->save();

        return redirect()->route('peminjaman.index');
    }

}
