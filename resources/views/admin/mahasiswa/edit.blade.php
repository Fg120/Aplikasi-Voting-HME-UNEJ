@extends('admin.layouts.app')

@section('title', 'Edit User')

@push('css')
@endpush

@section('content')
    <div class="section-header shadow">
        <h1>Edit Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <form class="needs-validation" novalidate="" action="{{ route('admin.mahasiswa.update', Crypt::encrypt($mahasiswas->id)) }}" method="POST">
                        @csrf
                        {{-- <div class="card-header">
                            <h4>JavaScript Validation</h4>
                        </div> --}}
                        <div class="card-body row">
                            <div class="form-group col-sm-6">
                                <label>NIM</label>
                                <input type="text" class="form-control shadow" name="nim" required="" value="{{ $mahasiswas->nim }}">
                                <div class="invalid-feedback">
                                    What's your name?
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Nama</label>
                                <input type="text" class="form-control shadow" name="nama" required="" value="{{ $mahasiswas->nama }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukkan Nama!
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Email</label>
                                <input type="email" class="form-control shadow" name="email" required="" value="{{ $mahasiswas->email }}">
                                <div class="invalid-feedback">
                                    Silahkan Masukkan Email!
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>No. HP</label>
                                <div class="input-group shadow">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="text" class="form-control" name="hp" required="" value="{{ $mahasiswas->hp }}" placeholder="No. HP"
                                        aria-label="No. HP" aria-describedby="basic-addon1">
                                </div>
                                <div class="invalid-feedback">
                                    Silahkan Masukkan No. HP!!
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Select</label>
                                <select class="form-control shadow" name="angkatan" required="">
                                    <option value="">Pilih Angkatan</option>
                                    @php
                                        $year1 = date('Y');
                                        $year2 = $year1 - 6;

                                        for ($i = $year2; $i <= $year1; $i++) {
                                            if (old('angkatan') == $i) {
                                                $sel = 'selected';
                                            } elseif ($mahasiswas->angkatan == $i) {
                                                $sel = 'selected';
                                            } else {
                                                $sel = '';
                                            }
                                            echo "<option value=\"$i\" $sel >$i</option>";
                                        }
                                    @endphp
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan Pilih Angkatan!
                                </div>
                            </div>
                            @role('Superadmin')
                                <div class="form-group col-sm-6">
                                    <label>Password/Token <span class="text text-success"></span></label>
                                    <div class="input-group mb-3 shadow">
                                        <input type="password" id="password" name="password" class="form-control" value="{{ old('token') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="lihat()">Lihat</button>
                                        </div>
                                    </div>
                                </div>
                            @endrole
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-dark">Kembali</a>
                            <button class="btn btn-primary">Submit</button>
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
