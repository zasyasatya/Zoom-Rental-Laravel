@extends('home.layouts.app')
@section('title', 'Data Pengajuan')
@section('content')
    <div class="container-fluid">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0">Manajemen Pengajuan</h1>
            <a href="{{ route('pengajuan.create') }}" class="btn btn-info btn-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Pengajuan</span>
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body border-left-info  m-0 pb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="font-weight-bold"><i class="fa fa-fw fa-dollar-sign"></i> Jumlah Pengajuan
                        : {{ $jml_pinjam }}</p>
                    <button class="btn btn-secondary btn-sm refresh-button"><i class="fa fa-redo"></i></button>
                </div>
            </div>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Data Pengajuan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Nama Kegiatan</th>
                                <th>Zoom</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjaman as $key => $p)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $p->user->name }}</td>
                                <td>{{ $p->nama_kegiatan }}</td>
                                <td>{{ $p->zoom->nama_akun }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>
                                    @if ($p->status_request == 'terima')
                                        <span class="badge badge-pill badge-success">
                                            Diterima
                                        </span>
                                    @elseif($p->status_request == 'diproses')
                                        <span class="badge badge-pill badge-warning">
                                            Diproses
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-danger">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-info btn-sm"data-toggle="modal" data-target="#detailModal_{{ $p->id }}">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="detailModal_{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $p->zoom->nama_akun }}" readonly>
                                                    </div>
                                                    <label for="deskripsi" class="font-weight-bold">Deskripsi Kegiatan</label>
                                                    <div class="form-group">
                                                        <input id="deskripsi" type="text" class="form-control" name="deskripsi" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $p->deskripsi }}" readonly>
                                                    </div>
                                                    @if ($p->status_request == 'terima')
                                                    <label for="status_peminjaman" class="font-weight-bold">Status</label>
                                                    <div class="form-group">
                                                        <input id="status_peminjaman" type="text" class="form-control" name="status_peminjaman" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $p->status_request == 'terima' ? 'DITERIMA' : 'APPROVED'}}" readonly>
                                                    </div>
                                                    <label for="room_zoom" class="font-weight-bold">Room Zoom</label>
                                                    <div class="form-group">
                                                        <input id="room_zoom" type="text" class="form-control" name="room_zoom" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $p->room_zoom }}" readonly>
                                                    </div>
                                                    @elseif ($p->status_request == 'diproses')
                                                    <label for="status_peminjaman" class="font-weight-bold">Status</label>
                                                    <div class="form-group">
                                                        <input id="status_peminjaman" type="text" class="form-control" name="status_peminjaman" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $p->status_request == 'diproses' ? 'DIPROSES' : '-'}}" readonly>
                                                    </div>
                                                    @else 
                                                    <label for="status_peminjaman" class="font-weight-bold">Status</label>
                                                    <div class="form-group">
                                                        <input id="status_peminjaman" type="text" class="form-control" name="status_peminjaman" 
                                                        autofocus placeholder="Nama Akun Zoom" value="{{ $p->status_request == 'tolak' ? 'DITOLAK' : '='}}" readonly>
                                                    </div>
                                                    <label for="room_zoom" class="font-weight-bold">ALASAN PENOLAKAN</label>
                                                    <div class="form-group">
                                                        
                                                        {{ $p->alasan_penolakan }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        
                                        <a href="#" class="btn btn-danger btn-sm ml-1"data-toggle="modal" data-target="#deleteModal_{{ $p->id }}" >
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <div>
                                            @if ($p->status_request == 'terima')
                                                <a href="#" class="btn btn-success btn-sm ml-1"data-toggle="modal" data-target="#done{{ $p->id }}" >
                                                    <i class="fas fa-check-square"></i>
                                                </a>
                                                
                                            @else
                                                
                                            @endif
                                            <div class="modal fade" id="done{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah peminjaman sudah selesai?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <form class="user" action="{{ route('pengajuan.done')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$p->zoom_id}}">
                                                        <button type="submit" class="btn btn-primary">Selesai</button>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                      <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal_{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <a href="/home/mahasiswa/pengajuan-peminjaman/delete/{{$p->id}}">
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
