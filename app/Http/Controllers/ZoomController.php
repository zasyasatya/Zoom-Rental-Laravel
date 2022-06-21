<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zoom;

class ZoomController extends Controller
{
     public function index()
    {
        $zooms = Zoom::all();
        $total = Zoom::all()->count();
        return view('home.pages.zoom.index', ['id_page' => 'zoom',
                                                'zooms' => $zooms,
                                                'total' => $total]);
    }

    public function create()
    {
        $zooms = Zoom::all();
        return view('home.pages.zoom.create', ['id_page' => 'zoom',
                                                'zooms' => $zooms]);
    }

    public function store(Request $request) 
    {
        $validateData = $request->validate([
            'nama_akun' => 'required|string|max:255',
            'kapasitas' => 'required|integer|',
            'status' => 'required|in:dipinjam,kosong'
        ]);

        if ($validateData == FALSE) {
            return redirect('zoom.index')
                ->withErrors($validateData)
                ->withInput();
        }

        $zoom = new Zoom();
        $zoom->nama_akun = $request->nama_akun;
        $zoom->kapasitas = $request->kapasitas;
        $zoom->status = $request->status;

        $zoom->save();

        return redirect()->route('zoom.index');
    }

    public function edit($id)
    {
        $zoom = Zoom::where('id', $id)->first();
        return view('home.pages.zoom.update', ['id_page' => 'zoom',
                                                'zoom' => $zoom]);
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'nama_akun' => 'required|string|max:255',
            'kapasitas' => 'required|integer|',
            'status' => 'required|in:dipinjam,kosong'
        ]);

        if ($validateData == FALSE) {
            return redirect('zoom.index')
                ->withErrors($validateData)
                ->withInput();
        }
        
        $zoom = Zoom::find($request->id);
        $zoom->nama_akun = $request->nama_akun;
        $zoom->kapasitas = $request->kapasitas;
        $zoom->status = $request->status;

        $zoom->save();

        return redirect()->route('zoom.index');
    }

    public function destroy($id)
    {
        $zoom = Zoom::find($id);
        $zoom->delete();

        return redirect()->route('zoom.index');
    }
    
    public function sampah()
    {
        $zoom = Zoom::onlyTrashed()->get();
        $total = Zoom::onlyTrashed()->count();
        return view('home.pages.zoom.sampah', [
            'id_page' => 'sampah',
            'zoom' => $zoom,
            'total' => $total,
        ]);
    }

    public function recover($id)
    {
        $zoom = Zoom::onlyTrashed()->where('id',$id);
        $zoom->restore();
        return redirect()->route('zoom.sampah');
    }

    public function recoverall()
    {
                
        $zoom = Zoom::onlyTrashed();
        $zoom->restore();

        return redirect()->route('zoom.sampah');
    }


    public function hapuspermanen($id)
    {
        $zoom = Zoom::onlyTrashed()->where('id',$id);
        $zoom->forceDelete();
        return redirect()->route('zoom.sampah');
    }

    public function hapussemua()
    {
        $zoom = Zoom::onlyTrashed();
        $zoom->forceDelete();
        return redirect()->route('zoom.sampah');
    }


    //end untuk staff

    //start mahasiswa
    //untuk index yang tampil di mahasiswa
    public function mindex()
    {
        $zoom = zoom::all();    
        $jml_zoom = zoom::count();
        return view('home.pages.zoom.mindex', [
            'id_page' => 'zoom', 
            'zoom' => $zoom,
            'jml_zoom' => $jml_zoom,
        ]);
    }
}
