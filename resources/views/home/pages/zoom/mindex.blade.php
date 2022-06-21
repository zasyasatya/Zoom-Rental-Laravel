@extends('home.layouts.app')
@section('title', 'Data Zoom')
@section('content')
    <div class="container-fluid">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0">List Zoom</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body border-left-info  m-0 pb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="font-weight-bold"><i class="fas fa-fw fa-video"></i> Jumlah Zoom
                        : {{ $jml_zoom }}</p>
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
                                <th>Nama Akun Zoom</th>
                                <th>Kapasitas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zoom as $key => $z)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $z->nama_akun }}</td>
                                <td>{{ $z->kapasitas }}</td>
                                <td>
                                    @if ($z->status == 'kosong')
                                            <span class="badge badge-pill badge-success">
                                                Selesai/Tidak Dipinjam
                                            </span>
                                        @elseif($z->status == 'dipinjam')
                                            <span class="badge badge-pill badge-warning">
                                                Dipinjam
                                            </span>
                                        @endif
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
