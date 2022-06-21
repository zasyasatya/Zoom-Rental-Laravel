@extends('home.layouts.app')
@section('title', 'Data Peminjaman')
@section('content')
    <div class="container-fluid">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0">Manajemen Peminjaman</h1>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-info btn-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Peminjaman</span>
            </a>
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
                                <th>Deskripsi</th>
                                <th>Pengajuan</th>
                                <th>Peminjaman</th>
                                <th>Pengguna</th>
                                <th>Akun Zoom</th>
                                <th>Status Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pinjams as $key => $pinjam)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$pinjam->nama_kegiatan}}</td>
                                <td>{{$pinjam->deskripsi}}</td>
                                <td>
                                    @if ($pinjam->status_request == 'terima')
                                        <span class="badge badge-pill badge-success">
                                            Diterima
                                        </span>
                                    @elseif($pinjam->status_request == 'diproses')
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
                                    @if ($pinjam->status == 'kosong')
                                        <span class="badge badge-pill badge-success">
                                            Selesai/Tidak Dipinjam
                                        </span>
                                    @elseif($pinjam->status == 'dipinjam')
                                        <span class="badge badge-pill badge-warning">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-danger">
                                            Belum Ditentukan
                                        </span>
                                    @endif
                                </td>
                                <td>{{$pinjam->name}}</td>
                                <td>{{$pinjam->nama_akun}}</td>
                                <td>
                                    @if ($pinjam->status_request == 'tolak')
                                   
                                        <div class="d-flex justify-content-center">
                                            <a href="/home/staff/peminjaman/showApprove/{{$pinjam->id}}" class="btn btn-success btn-sm approve" data-toggle="modal" data-target="#approveModal_{{ $pinjam->id }}">
                                                <i class="fas fa-check-square" ></i>
                                            </a>
                                            {{-- Approve Modal --}}
                                            <div class="modal fade" id="approveModal_{{ $pinjam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 700px">
                                                <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Penerimaan Pengajuan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="user" action="{{ route('peminjaman.approve')}}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="id" value="{{$pinjam->id}}">
                                                            <input type="hidden" value="{{$pinjam->zoom_id}}" name="zoom">
                                                            <label for="alasan_penolakan" class="font-weight-bold"> Informasi Zoom </label>
                                                            <div class="form-group">
                                                                <input type="text" id="room_zoom"class="form-control @error('room_zoom') is-invalid @enderror" name="room_zoom"
                                                                    required autocomplete="room_zoom" autofocus placeholder="Room Zoom" height="500px">
                                                                    @error('Informasi Room Zoom')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                            <a href="{{ route('peminjaman.index') }}"><button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Kembali</button></a>
                                                            <button type="submit" class="btn btn-primary">Terima</button>
                                    
                                                        </form>
                                                
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                    @elseif ($pinjam->status_request == 'terima')
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="{{ $pinjam->status == 'dipinjam' ? '_' : '#' }}rejectModal_{{ $pinjam->id }}">
                                                <i class="fas fa-ban"></i>
                                            </a>
                                            {{-- Reject Modal --}}
                                            <div class="modal fade" id="rejectModal_{{ $pinjam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 700px">
                                                <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Penolakan Pengajuan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="user" action="{{ route('peminjaman.reject')}}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="id" value="{{$pinjam->id}}">
                                                            <input type="hidden" value="{{$pinjam->zoom_id}}" name="zoom">
                                                            <label for="alasan_penolakan" class="font-weight-bold"> Alasan Penolakan Pengajuan</label>
                                                            <div class="form-group">
                                                                <textarea id="alasan_penolakan"class="form-control @error('alasan_penolakan') is-invalid @enderror" name="alasan_penolakan"
                                                                    required autocomplete="alasan_penolakan" autofocus placeholder="Alasan Penolakan" height="500px"></textarea>
                                                                    @error('alasan_penolakan')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                            <a href="{{ route('peminjaman.index') }}"><button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Kembali</button></a>
                                                            <button type="submit" class="btn btn-primary">Tolak</button>
                                    
                                                        </form>
                                                
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <a href="/home/staff/peminjaman/showApprove/{{$pinjam->id}}" class="btn btn-success btn-sm approve" data-toggle="modal" data-target="#approveModal_{{ $pinjam->id }}">
                                                <i class="fas fa-check-square" ></i>
                                            </a>
                                            <div class="modal fade" id="approveModal_{{ $pinjam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 700px">
                                                <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Penerimaan Pengajuan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="user" action="{{ route('peminjaman.approve')}}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="id" value="{{$pinjam->id}}">
                                                            <input type="hidden" value="{{$pinjam->zoom_id}}" name="zoom">
                                                            <label for="alasan_penolakan" class="font-weight-bold"> Informasi Zoom </label>
                                                            <div class="form-group">
                                                                <input type="text" id="room_zoom"class="form-control @error('room_zoom') is-invalid @enderror" name="room_zoom"
                                                                    required autocomplete="room_zoom" autofocus placeholder="Room Zoom" height="500px">
                                                                    @error('Informasi Room Zoom')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                            <a href="{{ route('peminjaman.index') }}"><button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Kembali</button></a>
                                                            <button type="submit" class="btn btn-primary">Terima</button>
                                    
                                                        </form>
                                                
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="{{ $pinjam->status == 'dipinjam' ? '_' : '#' }}rejectModal_{{ $pinjam->id }}">
                                                <i class="fas fa-ban"></i>
                                            </a>
                                            <div class="modal fade" id="rejectModal_{{ $pinjam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 700px">
                                                <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Penolakan Pengajuan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="user" action="{{ route('peminjaman.reject')}}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="id" value="{{$pinjam->id}}">
                                                            <input type="hidden" value="{{$pinjam->zoom_id}}" name="zoom">
                                                            <label for="alasan_penolakan" class="font-weight-bold"> Alasan Penolakan Pengajuan</label>
                                                            <div class="form-group">
                                                                <textarea id="alasan_penolakan"class="form-control @error('alasan_penolakan') is-invalid @enderror" name="alasan_penolakan"
                                                                    required autocomplete="alasan_penolakan" autofocus placeholder="Alasan Penolakan" height="500px"></textarea>
                                                                    @error('alasan_penolakan')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                            <a href="{{ route('peminjaman.index') }}"><button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Kembali</button></a>
                                                            <button type="submit" class="btn btn-primary">Tolak</button>
                                    
                                                        </form>
                                                
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/home/staff/peminjaman/edit/{{ $pinjam->id }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal_{{ $pinjam->id }}" >
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                      <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal_{{ $pinjam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <a href="/home/staff/peminjaman/delete/{{$pinjam->id}}">
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

