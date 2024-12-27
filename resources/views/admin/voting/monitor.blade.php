@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('css')
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="section-header">
        <h1>Monitor</h1>
    </div>
    <div class="section-body">
        <h2 class="section-title">KANDIDAT</h2>
        <div class="row">
            @foreach ($kandidats as $item)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card shadow" style="display: grid;
  grid-template-columns: 120px auto;">
                        {{-- <div class="col"> --}}
                        <div style="">
                            <img src="{{ asset('storage/' . $item->foto) }}" class="rounded" style="width: 120px; height: 160px;" alt="Foto {{ $item->nama }}">
                        </div>
                        <div class="card-body py-0 pe-0 my-3 ps-3" style="">
                            <h5><span class="badge badge-primary">Nomor {{ $item->nomor }}</span></h5>
                            <h4 class="card-title">{{ $item->nama }}</h4>
                            <p style="font-size: 15px">Suara : {{ $item->voter }}</p>
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
                {{-- <div class="col-md-4 col-sm-6 col-12">
                    <div class="card shadow">
                        <div class="row">
                            <div class="col-5">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="rounded" style="width: 120px; height: 160px;" alt="Foto {{ $item->nama }}">
                            </div>
                            <div class="col-7 card-body p-0 my-3">
                                <h5><span class="badge badge-primary">Nomor Urut {{ $item->nomor }}</span></h5>
                                <h4 class="card-title">{{ $item->nama }}</h4>
                                <p style="font-size: 15px">Jumlah Suara : {{ $item->voter }}</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endforeach
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Log Voting</h2>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Angkatan</th>
                                        <th>Waktu Vote</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->user->nim }}</td>
                                            <td>{{ $item->user->nama }}</td>
                                            <td>{{ $item->user->angkatan }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->created_at)->isoFormat('H:m:s, D MMMM Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script> --}}
    <script>
        $("#myTable").dataTable();
    </script>
@endpush
