@extends('admin.layouts.app')

@section('title', 'Data Admin')

@push('css')
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="section-header shadow">
        <h1>Data Admin</h1>
        <div class="section-header-breadcrumb">
            @can('admin create')
                <a href="{{ route('admin.admin.create') }}" class="btn btn-sm btn-success">Create</a>
            @endcan
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Angkatan</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nim }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->angkatan }}</td>
                                            <td>{{ $item->roles->first()->name }}</td>
                                            <td>
                                                @can('admin edit')
                                                    <a href="{{ route('admin.admin.edit', Crypt::encrypt($item->id)) }}" type="button" class="btn btn-primary me-3">Edit</a>
                                                @endcan
                                                @can('admin view')
                                                    <a href="{{ route('admin.admin.show', Crypt::encrypt($item->id)) }}" type="button" class="btn btn-primary me-3">Detail</a>
                                                @endcan
                                                @can('admin delete')
                                                    @if (Auth::user()->id != $item->id)
                                                        <a onclick="hapus({{ $item->id }})" class="btn btn-danger text-white" data-id="{{ $item->id }}">Hapus</a>
                                                        <form action="{{ route('admin.admin.destroy', Crypt::encrypt($item->id)) }}" method="POST" class="hidden" id="deleteform-{{ $item->id }}">
                                                            @method('delete')
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <a class="btn btn-secondary text-white">Hapus</a>
                                                    @endif
                                                @endcan
                                            </td>
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
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    @can('admin delete')
        <script>
            function hapus(id) {
                event.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Selected file will be deleted permanently!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        // buttons: true,
                        // dangerMode: true,
                    })
                    .then((confirm) => {
                        // console.log(confirm);
                        if (confirm.value) {
                            $('#deleteform-' + id).submit();
                        }
                    });
            }
        </script>
    @endcan
@endpush
