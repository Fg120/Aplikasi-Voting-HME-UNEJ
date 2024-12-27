@extends('admin.layouts.app')

@section('title', 'Edit User')

@push('css')
    <link rel="stylesheet" href="{{ asset('node_modules/summernote/dist/summernote.css') }}">
@endpush

@section('content')
    <div class="section-header shadow">
        <h1>Edit Kandidat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.kandidat.index') }}">Kandidat</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <form class="needs-validation" novalidate="" action="{{ route('admin.kandidat.update', Crypt::encrypt($kandidats->id)) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="card-header">
                            <h4>JavaScript Validation</h4>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                        <script>
                                            // Loop through all the errors and display each one in an alert
                                            @foreach ($errors->all() as $error)
                                                alert("{{ $error }}");
                                            @endforeach
                                        </script>
                                    @endif

                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Nomor</label>
                                    <input type="number" class="form-control shadow" name="nomor" required="" value="{{ $kandidats->nomor }}">
                                    <div class="invalid-feedback">
                                        Silahkan Masukkan Nomor!
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>NIM</label>
                                    <input type="text" class="form-control shadow" name="nim" required="" value="{{ $kandidats->nim }}">
                                    <div class="invalid-feedback">
                                        What's your name?
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Nama</label>
                                    <input type="text" class="form-control shadow" name="nama" required="" value="{{ $kandidats->nama }}">
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
                                                } elseif ($kandidats->angkatan == $i) {
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
                                <div class="col-md-6 form-group d-flex">
                                    <img id="preview" class="rounded float-start" src="{{ old('old_img') ?? asset('storage/' . $kandidats->foto) }}"
                                        alt="" style="height: 280px; width: 210px">
                                    <div class="float-end">
                                        <div class="mb-3 custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                                            <label class="custom-file-label" for="foto">Pilih foto</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="old_img" id="old_img" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group row mb-4">
                                    <label class="col-form-label text-md-left col-12">VISI</label>
                                    <div class="col-sm-12">
                                        <textarea id="summernote1" name="visi" required>{!! old('visi'), $kandidats->visi !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group row mb-4">
                                    <label class="col-form-label text-md-left col-12">MISI</label>
                                    <div class="col-sm-12">
                                        <textarea id="summernote2" name="misi" required>{!! old('misi'), $kandidats->misi !!}</textarea>
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

    <script>
        const realImg = preview.src;
        console.log(realImg);
        foto.onchange = evt => {
            const [file] = foto.files
            if (file) {
                document.getElementById("old_img").value = URL.createObjectURL(file);
                preview.src = URL.createObjectURL(file)
            } else {
                preview.src = realImg
            }
        }
    </script>
    <script>
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
