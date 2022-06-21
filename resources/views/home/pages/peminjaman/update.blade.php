@extends('home.layouts.app')
@section('title', 'Update Peminjaman')
@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0">Update Peminjaman</h1>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-danger btn-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back To List</span>
            </a>
        </div>
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Update Data Peminjaman</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form class="user" action={{ route('peminjaman.update') }} method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$pinjam->id}}">
                        <label for="nama_kegiatan" class="font-weight-bold"> Nama Kegiatan </label>
                        <div class="form-group">
                            <input type="text" id="nama_kegiatan"class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan"
                            required autocomplete="nama_kegiatan" autofocus placeholder="Nama Kegiatan" height="500px" value="{{ $pinjam->nama_kegiatan }}">
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                        <label for="deskripsi" class="font-weight-bold"> Deskripsi Kegiatan </label>
                        <div class="form-group">
                            <input type="text" id="deskripsi"class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                            required autocomplete="deskripsi" autofocus placeholder="Deskripsi Kegiatan" height="500px" value="{{ $pinjam->deskripsi }}">
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                        <label for="tanggal" class="font-weight-bold">Tanggal Peminjaman</label>
                            <div class="form-group">
                                <input id="tanggal" type="date" class="form-control"
                                    name="tanggal" required autocomplete="tanggal" autofocus value="{{ $pinjam->tanggal }}">
                            </div>
                        <label for="jam" class="font-weight-bold">Jam Peminjaman</label>
                            <div class="form-group">
                                <input id="jam" type="time" class="form-control"
                                    name="jam" required autocomplete="jam" autofocus value="{{ $pinjam->jam }}">
                            </div>
                        <label for="akun_zoom" class="font-weight-bold"> Nama Akun Zoom </label>
                        <div class="form-group">
                            <select id="akun_zoom" class="form-control" name="akun_zoom" required
                                autofocus>
                                @foreach($akun_zoom as $akun)
                                    {{-- <option value="{{ $nama_akun->nama_akun }}">{{ $nama_akun->nama_akun}}</option> --}}
                                    <option value="{{ $akun->id }}">{{ $akun->nama_akun}}</option>
                                @endforeach
                                {{-- @foreach($akun_zoom2 as $akun)
                                    <option value="{{ $akun->id }}">{{ $akun->nama_akun}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <label for="durasi" class="font-weight-bold"> Durasi Peminjaman </label>
                        <div class="form-group">
                            <input type="text" id="durasi"class="form-control @error('durasi') is-invalid @enderror" name="durasi"
                            required autocomplete="durasi" autofocus placeholder="Durasi dalam satuan jam" height="500px" value="{{ $pinjam->durasi }}">
                            @error('durasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                        <a href="{{ route('peminjaman.index') }}"><button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button></a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
