@extends('home.layouts.app')
@section('title', 'Create Pengajuan')
@section('content')
    <div class="container-fluid">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0">Create Pengajuan</h1>
            <a href="{{ route('pengajuan.index') }}" class="btn btn-danger btn-sm btn-icon-split">
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
                <h6 class="m-0 font-weight-bold text-primary">Create Data Pengajuan</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form class="user" action={{ route('pengajuan.store') }} method="POST">
                        @csrf
                        <label for="nama_kegiatan" class="font-weight-bold"> Nama Kegiatan </label>
                        <div class="form-group">
                            <input type="text" id="nama_kegiatan"class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan"
                            required autocomplete="nama_kegiatan" autofocus placeholder="Nama Kegiatan" height="500px">
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                        <label for="deskripsi" class="font-weight-bold"> Deskripsi Kegiatan </label>
                        <div class="form-group">
                            <input type="text" id="deskripsi"class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                            required autocomplete="deskripsi" autofocus placeholder="Deskripsi Kegiatan" height="500px">
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                        <label for="tanggal" class="font-weight-bold">Tanggal Peminjaman</label>
                            <div class="form-group">
                                <input id="tanggal" type="date" class="form-control"
                                    name="tanggal" required autocomplete="tanggal" autofocus>
                            </div>
                        <label for="jam" class="font-weight-bold">Jam Peminjaman</label>
                            <div class="form-group">
                                <input id="jam" type="time" class="form-control"
                                    name="jam" required autocomplete="jam" autofocus>
                            </div>
                        <label for="akun_zoom" class="font-weight-bold"> Nama Akun Zoom </label>
                        <div class="form-group">
                            <select id="akun_zoom" class="form-control" name="akun_zoom" required
                                autofocus>
                                @foreach($akun_zoom as $akun)
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
                            required autocomplete="durasi" autofocus placeholder="Durasi dalam satuan jam" height="500px">
                            @error('durasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                        <a href="{{ route('pengajuan.index') }}"><button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button></a>
                    <button type="submit" class="btn btn-primary">Save Data</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
