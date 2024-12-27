@extends('admin.base')

@section('title', 'Home')

@section('link')
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-4">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @include('sweetalert::alert')
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h1 class="h2">Setting</h1>
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    {{-- <div class="btn-group me-2">
                                        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">Tambah</a>
                                        <a href="{{ route('admin.mahasiswa.export') }}" class="btn btn-success">Export</a>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped shadow">
                                        <thead>

                                            <tr>
                                                <th class="sorting">Nama</th>
                                                <th class="sorting">Status</th>
                                                <th class="sorting">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($settings as $item)
                                                    <td>{{ $item->nama }}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <p class="btn btn-success">Active</p>
                                                        @elseif ($item->status == 0)
                                                            <p class="btn btn-danger">Deactive</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <form method="POST" action="{{ route('admin.setting.enable', $item->id) }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary me-3">Enable</button>
                                                            </form>
                                                            <form method="POST" action="{{ route('admin.setting.disable', $item->id) }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary me-3">Disable</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Apakah anda yakin ingin menghapur record ini?`,
                    text: "Jika anda mengapus maka record akan hilang selamanya",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection

@section('script')
@endsection
