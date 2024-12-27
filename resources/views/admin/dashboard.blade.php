@section('title', 'Dashboard')

@extends('admin.layouts.app')

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Admin</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_admins }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total User</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_users }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Kandidat</h4>
                    </div>
                    <div class="card-body">
                        {{ $kandidats }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Users Not Vote</h4>
                    </div>
                    <div class="card-body">
                        {{ $b_vote }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Users Vote</h4>
                    </div>
                    <div class="card-body">
                        {{ $s_vote }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
