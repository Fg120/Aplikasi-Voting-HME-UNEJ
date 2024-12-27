@extends('admin.layouts.app')

@section('title', 'Create Kandidat')

@push('css')
    <link rel="stylesheet" href="{{ asset('node_modules/summernote/dist/summernote.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('node_modules/selectric/public/selectric.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}"> --}}
    <style>
        .dropdown-toggle::after {
            content: none;
        }
    </style>
@endpush

@section('content')
    <div class="section-header shadow">
        <h1>Create Kandidat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.kandidat.index') }}">Kandidat</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <form class="needs-validation" novalidate="" action="{{ route('admin.kandidat.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>Nomor</label>
                                    <input type="number" class="form-control shadow" name="nomor" required="" value="{{ old('nomor') }}">
                                    <div class="invalid-feedback">
                                        Silahkan Masukkan Nomor!
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>NIM</label>
                                    <input type="text" class="form-control shadow" name="nim" required="" value="{{ old('nim') }}">
                                    <div class="invalid-feedback">
                                        Silahkan Masukkan NIM!
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Nama</label>
                                    <input type="text" class="form-control shadow" name="nama" required="" value="{{ old('nama') }}">
                                    <div class="invalid-feedback">
                                        Silahkan Masukkan Nama!
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Angkatan</label>
                                    <select class="form-control shadow" name="angkatan" required="">
                                        <option value="">Pilih Angkatan</option>
                                        @php
                                            $year1 = date('Y');
                                            $year2 = $year1 - 6;

                                            for ($i = $year2; $i <= $year1; $i++) {
                                                if (old('angkatan') == $i) {
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
                                <div class="col-sm-6 form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="foto" id="image-upload" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group row mb-4">
                                    <label class="col-form-label text-md-left col-12">VISI</label>
                                    <div class="col-sm-12">
                                        <textarea id="summernote1" name="visi" required>{!! old('visi') !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group row mb-4">
                                    <label class="col-form-label text-md-left col-12">MISI</label>
                                    <div class="col-sm-12">
                                        <textarea id="summernote2" name="misi" required>{!! old('misi') !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('admin.kandidat.index') }}" class="btn btn-dark">Kembali</a>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('node_modules/summernote/dist/summernote.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}

    <script src="{{ asset('node_modules/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    {{-- <script src="{{ asset('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script> --}}

    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>

    <script>
        $('select').selectric('destroy');

        $(document).ready(function() {
            // $('#summernote').summernote();
            $('#summernote1').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    // ['table', ['table']],
                    // ['insert', ['link', 'picture', 'video']],
                    // ['insert', ['link']],
                    // ['view', ['fullscreen', 'codeview']],
                ],
            });
            $('#summernote2').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    // ['table', ['table']],
                    // ['insert', ['link', 'picture', 'video']],
                    // ['insert', ['link']],
                    // ['view', ['fullscreen', 'codeview']],
                ],
            });
        });
    </script>
@endpush
