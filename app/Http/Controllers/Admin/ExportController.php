<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LogVotingExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return view('admin.export.index');
    }

    public function user_all()
    {
        return Excel::download(new UsersExport(1), 'Data Pengguna HME semua.xlsx');
    }
    public function user_admin()
    {
        return Excel::download(new UsersExport(2), 'Data Pengguna HME admin.xlsx');
    }
    public function user_umum()
    {
        return Excel::download(new UsersExport(3), 'Data Pengguna HME umum.xlsx');
    }
    public function user_unvote()
    {
        return Excel::download(new UsersExport(4), 'Data Pengguna HME belum vote.xlsx');
    }
    public function user_voted()
    {
        return Excel::download(new UsersExport(5), 'Data Pengguna HME sudah vote.xlsx');
    }

    public function log_voting()
    {
        return Excel::download(new LogVotingExport, 'Data Log Voting HME.xlsx');
    }
}
