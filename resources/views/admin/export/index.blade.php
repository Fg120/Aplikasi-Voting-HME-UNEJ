@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('css')
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="section-header">
        <h1>Export</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h6><i class="fas fa-user"></i> User</h6>
                        <div class="buttons">
                            <a href="{{route('admin.export.user_all')}}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-edit"></i> Semua</a>
                            <a href="{{route('admin.export.user_admin')}}" class="btn btn-icon icon-left btn-dark"><i class="fas fa-user-cog"></i> Admin</a>
                            <a href="{{route('admin.export.user_umum')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-user"></i> Umum</a>
                            <a href="{{route('admin.export.user_unvote')}}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-exclamation-triangle"></i> Belum Vote</a>
                            <a href="{{route('admin.export.user_voted')}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Sudah Vote</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6><i class="fas fa-user"></i> Log Voting</h6>
                        <div class="buttons">
                            <a href="{{route('admin.export.log_voting')}}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-edit"></i> Log Voting</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
