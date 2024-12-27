@extends('admin.layouts.app')

@section('title', 'Detail User')

@push('css')
@endpush

@section('content')
    <div class="section-header shadow">
        <h1>Detail Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <form class="needs-validation" novalidate="" action="{{ route('admin.mahasiswa.update', Crypt::encrypt($mahasiswas->id)) }}" method="POST">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-sm-6">
                                <label>NIM</label>
                                <input type="text" class="form-control shadow" name="nim" required="" value="{{ $mahasiswas->nim }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Nama</label>
                                <input type="text" class="form-control shadow" name="nama" required="" value="{{ $mahasiswas->nama }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Email</label>
                                <input type="email" class="form-control shadow" name="email" required="" value="{{ $mahasiswas->email }}" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label>No. HP</label>
                                <div class="input-group shadow">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="text" class="form-control" name="hp" required="" value="{{ $mahasiswas->hp }}" placeholder="No. HP"
                                        aria-label="No. HP" aria-describedby="basic-addon1" readonly>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Angkatan</label>
                                <input type="text" class="form-control shadow" name="angkatan" required="" value="{{ $mahasiswas->angkatan }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Password/Token</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control" value="{{ Crypt::decrypt($mahasiswas->token) }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" onclick="lihat()">Lihat</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-end">
                            <div class="text-left">
                                <label>Token</label>
                                <div class="buttons">
                                    <a target="_blank"
                                        href="https://wa.me/+62{{ $mahasiswas->hp }}?text=Halo%20sobat%20HME%0ABerikut%20adalah%20token%20kamu%20yang%20digunakan%20untuk%20login%20pada%20website%20({{ config('app.url') }})%0A%0A%22{{ Crypt::decrypt($mahasiswas->token) }}%22"
                                        class="btn btn-icon icon-left btn-success m-0"><i class="fab fa-whatsapp"></i>Whatsapp</a>
                                    <a href="{{ route('admin.mahasiswa.send_token', Crypt::encrypt($mahasiswas->id)) }}" class="btn btn-icon icon-left btn-info m-0"><i
                                            class="fas fa-envelope"></i>Email</a>

                                    {{-- <div class="btn btn-success">hello</div> --}}
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-dark">Kembali</a>
                            </div>
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
