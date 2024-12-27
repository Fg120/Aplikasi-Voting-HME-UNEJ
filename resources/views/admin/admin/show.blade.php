@extends('admin.layouts.app')

@section('title', 'Detail User')

@push('css')
@endpush

@section('content')
    <div class="section-header shadow">
        <h1>Detail Admin</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.admin.index') }}">Admin</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <form class="needs-validation" novalidate="" action="{{ route('admin.admin.update', Crypt::encrypt($admins->id)) }}" method="POST">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-sm-6">
                                <label>NIM</label>
                                <input type="text" class="form-control shadow" name="nim" required="" value="{{ $admins->nim }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Nama</label>
                                <input type="text" class="form-control shadow" name="nama" required="" value="{{ $admins->nama }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Email</label>
                                <input type="email" class="form-control shadow" name="email" required="" value="{{ $admins->email }}" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label>No. HP</label>
                                <div class="input-group shadow">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="text" class="form-control" name="hp" required="" value="{{ $admins->hp }}" placeholder="No. HP" aria-label="No. HP"
                                           aria-describedby="basic-addon1" readonly>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Angkatan</label>
                                <input type="text" class="form-control shadow" name="angkatan" required="" value="{{ $admins->angkatan }}" readonly>
                            </div>
                            @role ('Superadmin')
                                <div class="form-group col-sm-6">
                                    <label>Token</label>
                                    <div class="input-group mb-3 shadow">
                                        <input type="password" id="password" class="form-control" value="{{ Crypt::decrypt($admins->token) }}" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="lihat()">Lihat</button>
                                        </div>
                                    </div>
                                </div>
                            @endrole
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.admin.index') }}" class="btn btn-dark">Kembali</a>
                        </div>
                    </form>
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
