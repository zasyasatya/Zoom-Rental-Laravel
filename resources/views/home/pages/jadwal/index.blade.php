@extends('home.layouts.app')
@section('title', 'Data Jadwal Peminjaman')
@section('content')
    <div class="container-fluid">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0">Jadwal Peminjaman</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body border-left-info  m-0 pb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="font-weight-bold"><i class="fa fa-fw fa-window-restore"></i> Jumlah Peminjaman
                        ({{$total}})</p>
                    <button class="btn btn-secondary btn-sm refresh-button"><i class="fa fa-redo"></i></button>
                </div>
            </div>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Data Peminjaman</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Pengguna</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pinjams as $key => $pinjam)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$pinjam->nama_kegiatan}}</td>
                                <td>{{$pinjam->user->name}}</td>
                                <td>{{$pinjam->tanggal}}</td>
                                <td>{{$pinjam->jam}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal_{{ $pinjam->id }}">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    <!-- Delete Modal -->
                                        <div class="modal fade" id="detailModal_{{ $pinjam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Info</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="nama_akun" class="font-weight-bold">Nama Akun Zoom</label>
                                                    <div class="form-group">
                                                        <input id="nama_akun" type="text" class="form-control" name="nama_akun" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $pinjam->zoom->nama_akun }}" readonly>
                                                    </div>
                                                    <label for="room_zoom" class="font-weight-bold">Room Zoom</label>
                                                    <div class="form-group">
                                                        <input id="room_zoom" type="text" class="form-control" name="room_zoom" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $pinjam->room_zoom }}" readonly>
                                                    </div>
                                                    <label for="durasi" class="font-weight-bold">Durasi Peminjaman</label>
                                                    <div class="form-group">
                                                        <input id="durasi" type="text" class="form-control" name="durasi" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $pinjam->durasi }} jam" readonly>
                                                    </div>
                                                    <label for="deskripsi" class="font-weight-bold">Deskripsi Kegiatan</label>
                                                    <div class="form-group">
                                                        <input id="deskripsi" type="text" class="form-control" name="deskripsi" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $pinjam->deskripsi }}" readonly>
                                                    </div>
                                                    <label for="status_peminjaman" class="font-weight-bold">Status Peminjaman</label>
                                                    <div class="form-group">
                                                        <input id="status_peminjaman" type="text" class="form-control" name="status_peminjaman" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $pinjam->zoom->status == 'dipinjam' ? 'Sedang Dipinjam' : 'Selesai' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
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
