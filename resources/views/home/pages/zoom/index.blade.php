@extends('home.layouts.app')
@section('title', 'Data Zoom')
@section('content')
    <div class="container-fluid">

        <div class="d-flex align-items-right justify-content-between mb-4">
            <h1 class="h4 mb-0">Manajemen Zoom</h1>
            <a href="{{ route('zoom.create') }}" class="btn btn-info btn-sm btn-icon-split" >
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Zoom</span>
            </a>
        </div>
        <div class="d-flex flex-row-reverse justify-content-between mb-4">
            <a href="{{ route('zoom.sampah') }}" class="btn btn-primary btn-sm btn-icon-split" >
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Recycle Bin</span>
            </a>

        </div>
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
                <h6 class="m-0 font-weight-bold text-primary">List Data Zoom</h6>
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
                            @foreach ($zooms as $key => $zoom)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $zoom->nama_akun}}</td>
                                    <td>{{ $zoom->kapasitas}}</td>
                                    <td>
                                        @if ($zoom->status == 'kosong')
                                            <span class="badge badge-pill badge-success">
                                                Selesai/Tidak Dipinjam
                                            </span>
                                        @elseif($zoom->status == 'dipinjam')
                                            <span class="badge badge-pill badge-warning">
                                                Dipinjam
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/home/staff/zoom/edit/{{$zoom->id}}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal_{{ $zoom->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal_{{ $zoom->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                <a href="/home/staff/zoom/delete/{{$zoom->id}}">
                                                    <button type="button" class="btn btn-primary">Hapus</button>
                                                </a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
