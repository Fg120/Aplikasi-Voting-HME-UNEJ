@extends('admin.layouts.app')

@section('title', 'Detail User')

@push('css')
@endpush

@section('content')
    <div class="section-header shadow">
        <h1>Detail Kandidat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.kandidat.index') }}">Kandidat</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body row d-flex ">
                        <div class="col-sm-4">
                            <img src="{{ asset('storage/' . $kandidats->foto) }}" alt="" style="width: 100%">
                        </div>
                        <div class="form-group col-sm-8 ">
                            <label>Nomor</label>
                            <input type="text" class="form-control shadow" name="nomor" required="" value="{{ $kandidats->nomor }}" readonly>
                            <label>NIM</label>
                            <input type="text" class="form-control shadow" name="nim" required="" value="{{ $kandidats->nim }}" readonly>
                            <label>Nama</label>
                            <input type="text" class="form-control shadow" name="nama" required="" value="{{ $kandidats->nama }}" readonly>
                            <label>Angkatan</label>
                            <input type="text" class="form-control shadow" name="angkatan" required="" value="{{ $kandidats->angkatan }}" readonly>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <span class="badge badge-primary">VISI</span>
                            <div class="card shadow">
                                <div class="card-body">
                                    {!! $kandidats->visi !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <span class="badge badge-primary">MISI</span>
                            <div class="card shadow">
                                <div class="card-body">
                                    {!! $kandidats->misi !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.kandidat.index') }}" class="btn btn-dark">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        function lihat() {
            jenis = document.getElementById("password");
            if (jenis.type == "password") {
                jenis.type = "text";
            } else {
                jenis.type = "password";
            }
        }
    </script>
@endpush
