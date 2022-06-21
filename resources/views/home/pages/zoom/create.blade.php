@extends('home.layouts.app')
@section('title', 'Create Zoom')
@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0">Create Zoom</h1>
            <a href="{{ route('zoom.index') }}" class="btn btn-danger btn-sm btn-icon-split">
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
                <h6 class="m-0 font-weight-bold text-primary">Create Data Zoom</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form class="user" action="{{ route('zoom.store')}}" method="POST">
                        @csrf
                        
                        <label for="nama_akun" class="font-weight-bold">Nama Akun Zoom</label>
                        <div class="form-group">
                            <input id="nama_akun" type="text" class="form-control @error('nama_akun') is-invalid @enderror" name="nama_akun"
                                required autocomplete="nama_akun" autofocus placeholder="Nama Akun Zoom">
                                @error('nama_akun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <label for="kapasitas" class="font-weight-bold">Kapasitas</label>
                        <div class="form-group">
                            <input id="kapasitas" type="text" class="form-control @error('kapasitas') is-invalid @enderror"" name="kapasitas"
                                required autocomplete="kapasitas" autofocus placeholder="Kapasitas">
                                @error('kapasitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <label for="status" class="font-weight-bold">Status</label>
                        <div class="form-group">
                            <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required
                                autocomplete="status" autofocus>
                                    <option value="kosong">Kosong</option>
                                    <option value="dipinjam">Dipinjam</option>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </select>
                        </div>
                        <a href="{{ route('zoom.index') }}"><button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button></a>
                        <button type="submit" class="btn btn-primary">Save Data</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
