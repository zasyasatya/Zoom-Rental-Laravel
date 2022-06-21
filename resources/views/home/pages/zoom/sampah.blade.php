@extends('home.layouts.app')
@section('title', 'Data Sampah Zoom')
@section('content')
<div class="container-fluid">
    <h2>Sampah Zoom</h2>
    

    <div class="card shadow mb-4">
        <div class="card-body border-left-info  m-0 pb-0">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <p class="font-weight-bold"><i class="fas fa-fw fa-user-circle"></i> Jumlah Zoom
                    ({{ $total }})</p>
                <button class="btn btn-secondary btn-sm refresh-button"><i class="fa fa-redo"></i></button>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sampah Zoom</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Akun</th>
                            <th>Kapasitas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($zoom as $key => $zm)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $zm->nama_akun}}</td>
                                <td>{{ $zm->kapasitas}}</td>
                                <td>
                                    @if ($zm->status == 'kosong')
                                        <span class="badge badge-pill badge-success">
                                            Selesai/Tidak Dipinjam
                                        </span>
                                    @elseif($zm->status == 'dipinjam')
                                        <span class="badge badge-pill badge-warning">
                                            Dipinjam
                                        </span>
                                    @endif
                                </td>
                                <div class="d-flex justify-content-center">
                                <td>
                                    <a href="/home/staff/zoom/recover/{{ $zm->id }}" class="btn btn-success btn-sm" onclick="javascript: return confirm('Restore data?')"><i class="fa fa-recycle"></i> </a>
                                    
                                    <a href="/home/staff/zoom/dltperm/{{ $zm->id }}" class="btn btn-danger btn-sm" onclick="javascript: return confirm('Yakin ingin Hapus Permanen data?')"><i class="fa fa-trash"></i> </a>
                                </td>
                                </div>
                            </tr> 
            @endforeach
        </tbody>
        </table>
    </div>
        </div>
    </div>
    <div class="float-right">
        <a href="/home/staff/zoom/recoverall" onclick="javascript: return confirm('Kembalikan semua data?')">
            <button class="btn btn-success">Recover All</button>
        </a>
        |
        <a href="/home/staff/zoom/deleteall" onclick="javascript: return confirm('Kosongkan Recycle Bin?')">
            <button class="btn btn-danger">Delete All</button>
        </a>
    </div>
</div>
@endsection