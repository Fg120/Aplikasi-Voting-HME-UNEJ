@extends('admin.layouts.app')

@section('title', 'Data Kandidat')

@push('css')
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('node_modules/prismjs/themes/prism.css') }}"> --}}
@endpush

@section('content')
    <div class="section-header shadow">
        <h1>Setting</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <thead>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach ($settings as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <p class="btn btn-danger">Deactive</p>
                                                @elseif ($item->status == 1)
                                                    <p class="btn btn-success">Active</p>
                                                @elseif ($item->status == 2)
                                                    <p class="btn btn-warning">Scheduled</p>
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                {{-- <div class="d-flex"> --}}
                                                <form class="hidden" method="POST" action="{{ route('admin.setting.voting.enable', $item->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Enable</button>
                                                </form>
                                                <form class="hidden" method="POST" action="{{ route('admin.setting.voting.disable', $item->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Disable</button>
                                                </form>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Schedule</button>
                                                {{-- </div>0 --}}
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

@push('modal')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.setting.voting.schedule') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Start Date:</label>
                            <input type="text" name="start_date" class="form-control datetimepicker">
                        </div>
                        <div class="form-group">
                            <label>End Date:</label>
                            <input type="text" name="end_date" class="form-control datetimepicker">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('js')
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('node_modules/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('node_modules/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    {{-- <script src="{{ asset('node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script> --}}
    <script src="{{ asset('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('node_modules/selectric/public/jquery.selectric.min.js') }}"></script>

    {{-- <script src="{{ asset('/assets/js/page/forms-advanced-forms.js') }}"></script> --}}
    {{-- <script src="{{ asset('node_modules/prismjs/prism.js') }}"></script> --}}
    <script>
        $("#myTable").dataTable();
    </script>
@endpush
